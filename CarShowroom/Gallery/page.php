<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "showroom";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo "Connection exception: " . $e->getMessage();
}

$sql = $connection->prepare("SELECT * FROM car");
$sql->execute();
$cars = $sql->fetchAll();

if (isset($_POST['showCars'])) {

    $sql = $connection->prepare("SELECT * FROM car 
                                JOIN carImages on car.images_ID = carImages.images_ID 
                                WHERE brand = ?");
    $sql->execute([ $_POST['brand']]);
    $chosenBrand = $sql->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Navbar/navbarStyle.css">
</head>
<body>

    <?php include("../Navbar/navbar.php"); ?>

    <form action="" method="post">
        <label for="brand">Изберете марка:</label>
        <select name="brand" required>
            <option value="" selected>Choose Brand</option>
            <?php foreach ($cars as $car) { ?>
                <option value="<?= $car["brand"] ?>"><?= $car["brand"] ?></option>  
            <?php } ?>
        </select>
        <button type="submit" name="showCars">Show cars</button>
    </form>
    
    <!-- Create DIVs with cars -->
    <?php foreach ($chosenBrand as $car) { ?>
        <div class="carContainer">
            <img src="<?=$car['carFrontImage'] ?>" alt="FrontImage">
            <img src="<?=$car['carBackImage'] ?>" alt="Back Image">
            <img src="<?=$car['carInteriorImage'] ?>" alt="Interior Image">
        </div>
    <?php } ?>

</body>
</html>