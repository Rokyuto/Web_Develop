<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Navbar/navbarStyle.css">
</head>
<body>
    <?php include("../Navbar/navbar.php") ?>
    <h1>UKTC Showroom</h1>
    <div class="container">
        <form action="#" method="post">
            <h2>Вписване</h2>
            <div class="item">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" autocomplete="off" placeholder="Enter Email" required>
            </div>
            <div class="item">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter Password" required>
            </div>
            <a href="../RegisterPage/register.php">DON'T HAVE ACCOUNT</a><br><br>
            <div class="button_container">
                <button type="submit" name="login">LOGIN</button>
            </div>
        </form>
    </div>

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

if (isset($_POST['login'])) {

    $sql = $connection->prepare("SELECT * FROM user WHERE email = ?");
    $sql->execute([ $_POST['email']]);
    $result = $sql->fetch();

    if($result){
        if(password_verify($_POST['password'],$result["password"])){
          $_SESSION['user'] = $result;
          if ($_SESSION['user'][1] == "admin") {
            header("location: ../AdminPanel/page.php");
          }
          else {
            header("location: ../Gallery/page.php");
          }
          exit;
        }
    }
}

?>