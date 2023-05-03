<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST">
        <h1>Регистриране</h1>
        <div class="item">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" autocomplete="off" placeholder="Enter Username" required>
        </div>
        <div class="item">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" autocomplete="off" placeholder="Enter Email" required>
        </div>
        <div class="item">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter Password" required>
        </div>
        <div class="item">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="off" placeholder="Confirm Password" required>
        </div>
        <div class="button_container">
            <button type="submit" name="register">REGISTER</button>
        </div>
    </form>
</body>
</html>

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "showroom";
session_start();
try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo "Connection exception: " . $e->getMessage();
}

if ( isset( $_POST['register'] ) ) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    if($password == $passwordConfirmation){
      $hash_pass = password_hash($password,PASSWORD_BCRYPT);
      
      $sql = "INSERT INTO user ( username, email,password) VALUES (?,?,?)";
      $connection->prepare($sql)->execute([$username,$email,$hash_pass]);

      header("location: ../HomePage/home.php");

    }else{
      echo "Missmatch";
    }
}
?>