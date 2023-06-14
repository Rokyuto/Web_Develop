<?php
session_start();
    
  $conn = new mysqli("localhost","root","","book_flights");

  if(isset($_SESSION['user'])) {
    $email = $_SESSION['user']['email'];
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);
  
    if($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $currentUsername = $row['username'];
      $currentEmail = $row['email'];
      $currentPassword = $row['password'];
    }
    } else {
      // Handle error if user not found in database
      $username = "Guest";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $newUsername = $_POST['username'];
      $newEmail = $_POST['email'];
      $newPassword = $_POST['password'];
      $hash_password = password_hash($newPassword,PASSWORD_BCRYPT);

      // Update user data query syntax
      $sql = "UPDATE users SET username='$newUsername', email='$newEmail', password='$hash_password' WHERE username='$currentUsername' OR email='$currentEmail' OR password='$currentPassword'";
      if ($conn->query($sql) == TRUE && $oldEmail != $newEmail){ // Check if the query is successful and the email is updated
        session_destroy();
        header('Location:../AccountPage/LoginPage.php'); // Go to the account page to log in again with the new email
        exit();
      }elseif ($conn->query($sql) == TRUE) {
          header('Location:../HomePage/HomePage.php');
          exit();
      } else {
        echo "Error updating record: " . $conn->$error;
      }
    }
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Edit Profile</title>
      <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  
      <link rel="stylesheet" href="EditProfile.css">
      <link rel="icon" href="../Images/FafiIcon.png">
  </head>

  <body>
    <button class="back" onclick="window.history.go(-1);">Back</button>
    <form  class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <p class="title">Edit your info</p>
      <input type="text" name="username" required autocomplete="off"  value="<?php echo $currentUsername; ?>">
      <input type="email" name="email"  required autocomplete="off"  value="<?php echo $currentEmail; ?>" >
      <input type="password" name="password" required autocomplete="off" value="">
      <button class="button" name="sumbit" value="Update">Update</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>