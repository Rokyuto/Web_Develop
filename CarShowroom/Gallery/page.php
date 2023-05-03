<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="../Navbar/navbarStyle.css">
</head>
<body>

    <?php include("../Navbar/navbar.php"); ?>

    <form action="" method="post">
        <label for="brand">Изберете марка:</label>
        <select name="brand">
            <?php for ($i=0; $i < count($result); $i++){ ?>
                <option value='<?php $result[$i]["brand"]; ?>'><?php $result[$i]["brand"]; ?></option>  
            <?php } ?>
        </select>
        <button type="submit" name="showCars">Show cars</button>
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
$sql = $connection->prepare("SELECT * FROM cars");
$sql->execute();
$result = $sql->fetch();

if (isset($_POST['showCars'])) {

    $sql = $connection->prepare("SELECT * FROM cars WHERE brand = ?");
    $sql->execute([ $_POST['brand']]);
    $result = $sql->fetch();
}

?>