<?php
    $servername = "localhost";
    $username = "helper";
    $password = "vmm_123";
    $database = "book_flights";
    session_start(); // Start session

    try { // Try to connect to the database
        $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) { // Catch Block for Exceptions
        echo "Connection failed: " . $e->getMessage();
    }

    if ( isset( $_POST['Signup'] ) ) { // If Signup Button is clicked

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $registerErrors = []; // Define Array of Errors

        // ------------------------------------------------------------ PASSWORD VALIDATION ------------------------------------------------------------

        $pattern = "/[A-Z]/i"; // Pattern for password to contains an UPPER LETTER
        if(preg_match($pattern, $password) != 1){ // preg_match() returns 1 if it's found UPPER letter
            $registerErrors[] = "Password must contains upper letter !";
        }

        $pattern = "/\d/i"; // Pattern for password to contains a digit
        if(preg_match($pattern, $password) != 1){ // preg_match() returns 1 if it's found UPPER digit
            $registerErrors[] = "Password must contains digit !";
        }
        if(strlen($password) < 8){ // If the password's length is less than 8 characters
            $registerErrors[] = "Ivalid password length !";
        }
        if($password != $confirmPassword){ // If password is not the same as confirmation field's password
            $registerErrors[] = "Passwords do not mach !";
        }

        // ------------------------------------------------------------ EMAIL VALIDATION ------------------------------------------------------------

        // Query to check if there is registered user with the entered email
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $connection->prepare($sql);
        $query->execute([$email]);
        $data =  $query->fetchAll();
        // If it's found user with this email, add message to the errors array
        if(count($data) != 0)
        {
            $registerErrors[] = "This email is allready registered !";
        }

        // --------------------------------------------------- PRINT ERRORS OR REGISTER USER STAGE ---------------------------------------------------

        //Проверка дали имаме грешки в инпут полетата
        if(count($registerErrors) == 0)
        {
            $hash_password = password_hash($password,PASSWORD_BCRYPT);
            
            $sql = "INSERT INTO users ( username, email,password) VALUES (?,?,?)"; // Query Template / Statement
            $connection->prepare($sql)->execute([$username,$email,$hash_password]); // Execute the Query with the given Username,Email and Password on "?" place

            header("location: LoginPage.php");
        }
        else{ 
            for($i = 0; $i < count($registerErrors); $i++)
            {
                //echo '<div class="message"><br><b style="color:red; ">'. $registerErrors[$i] .'</b></div>';
                echo '<p style="color: red; text-align: center;"><strong>' . $registerErrors[$i] . '</strong></p><br>';
            }
        }
    }
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Page</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="Style.css">
  <link rel="icon" href="../Images/FafiIcon.png">
</head>
<body>
    <button class="back" onclick="window.history.go(-1);">Back</button>
    <div class="form">
        <header>Signup</header>
        <form action="#" method="POST">
            <p style="text-decoration: none; color:red;">*Must contains minimum 4 characthers.</p>
            <input type="text" name="username" placeholder="Enter your username" required autocomplete="off" minlength="4" maxlength="20">

            <p style="text-decoration: none; color:red;">*Must contains {characher}@{extention}.</p>
            <input type="email" name="email" placeholder="Enter your email" required autocomplete="off">

            <p style="text-decoration: none; color:red;">*Must contains 1 capital letter, special character and min 8 characters length.</p>
            <input type="password" name="password" placeholder="Enter a password" required autocomplete="off">
            <input type="password" name="confirmPassword" placeholder="Confirm your password" required autocomplete="off">

            <button class="button" name="Signup">Signup</button>
        </form>
        <span>Already have an account?
            <a href="LoginPage.php">Login</a>
        </span>
    </div>
</body>
</html>

