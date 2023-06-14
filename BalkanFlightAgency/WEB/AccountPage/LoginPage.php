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
    <header>Login</header>
    <form action="#" method="POST">
      <input type="email" name="email" placeholder="Enter your email" required autocomplete="off">
      <input type="password" name="password" placeholder="Enter your password" required autocomplete="off">
      <button class="button" name="Login">Login</button>
    </form>
    <span >Don't have an account?
      <a href="RegisterPage.php">Signup</a>
    </span>
  </div>
</body>
</html>

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

  if(isset($_POST['Login'])){ // If Login Button is clicked

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM users WHERE email = ?"); // Query Template / Statement
    $query->execute([ $email]); // Execute the Query with the given Email on "?" place
    $user = $query->fetch(); // Fetch (Search and Return) for Results

    if($user){ // If user FOUND, then compare passwords
      if(password_verify($password,$user["password"])){ // If the found user's password is the same as the entered login password
        $_SESSION['user'] = $user; // Save the found User as a Session
        unset($_SESSION['flightNotFound']); // Delete flightNotFound Variable from Session array
        // if($_SESSION['user'][4] == 1){ // Check if the loged user is ADMIN
        //   header("location: ../AdminPanel/showFlights.php"); // Navigate to the Admin Panel Page
        // }
        // else{ // If it's regular user
        //   header("location: ../HomePage/HomePage.php"); // Navigate to the Home Page
        // }
        header("location: ../HomePage/HomePage.php"); // Navigate to the Home Page
        exit;
      } else {
        echo "<script style='color:red;>alert('Невалидни потребителски данни)</script>";
      }
    }
  }
	
?>