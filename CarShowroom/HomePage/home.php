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
            <button onclick="location.href = '../LoginRegisterPages/login.php'">Login</button>
            <button onclick="location.href = '../LoginRegisterPages/register.php'">Register</button>
        </div>
    </body>
</html>