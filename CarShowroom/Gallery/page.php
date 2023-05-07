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

$sql = $connection->prepare("SELECT * FROM car JOIN carImages on car.images_ID = carImages.images_ID ");
$sql->execute();
$cars = $sql->fetchAll();

$chosenBrandCars = [];
$chosenBrand;

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

    <!-- Create DIVs with cars -->
    <?php 
    foreach ($cars as $car) { ?>
        <div class="carContainer">
            <div class="carInfo">
                <h2><?= $car["brand"] . " " . $car["model"] . " " . $car["year"] ?></h2>
                <p><?= $car["horsePower"] ?> конски сили</p>
                <p><?= $car["color"] ?> цвят</p>
                <p><?= $car["description"] ?></p>
                <p>Цена: <?= $car["price"] ?> евро</p>
            </div>
            <img id="car<?= $car["car_id"] ?>" src="<?= $car["carFrontImage"] ?>"  alt="">
        </div>
    <?php } ?>
    
    <script>
        counter = 0;
        function setImage(){
            <?php foreach ($cars as $car){?>
            var images = [ '<?= $car["carFrontImage"] ?>', '<?= $car["carBackImage"] ?>', '<?= $car["carInteriorImage"] ?>' ];
            var randomIndex = Math.floor(Math.random() * images.length);
            var randomImage = images[counter];
            document.getElementById("car<?= $car["car_id"] ?>").src = randomImage;
            <?php } ?>
            counter++;
            if(counter >= 3){
                counter = 0;
            }
        }
        setInterval(setImage, 3000);
    </script>

</body>
</html>