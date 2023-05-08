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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Navbar/navbarStyle.css">
</head>
<body>

    <?php include("../Navbar/navbar.php"); ?>

    <div class="form">
        <form action="#" method="post">
            <h1>Добавяне на кола</h1>
            <div class="container">
                <input type="text" name="brand" id="brand" autocomplete="off" placeholder="Въведи марка" required>
                <input type="text" name="model" id="model" autocomplete="off" placeholder="Въведи модел" required>
                <input type="color" name="color" id="color" autocomplete="off" required>
                <input type="number" name="price" id="price" autocomplete="off" placeholder="Въведи цена на автомобила" min="500" required>
                <input type="number" name="horsePower" id="horsePower" autocomplete="off" min="1" placeholder="Въведи конски сили" required>
                <input type="number" name="year" id="year" autocomplete="off" placeholder="Въведи година на производство" min="<?php echo date("Y-m-d"); ?>" required>
            </div>
            <div class="item_container">
                <label for="carFrontImage">Снимка отпред:</label>
                <input type="file" name="carFrontImage" id="carFrontImage" autocomplete="off" required>
            </div>
            <div class="item_container">
                <label for="carBackImage">Снимка отзад:</label>
                <input type="file" name="carBackImage" id="carBackImage" autocomplete="off" required>
            </div>
            <div class="item_container">
                <label for="carInteriorImage">Снимка вътре:</label>
                <input type="file" name="carInteriorImage" id="carInteriorImage" autocomplete="off" required>
            </div>
            <div class="button_container">
                <input type="submit" name="submit" id="submit" value="Submit">
            </div>
        </form>
    </div>
    <div class="form">
        <form action="#" method="post">
            <h1>Добавяне на град</h1>
            <div class="container">
                <input type="text" name="cityName" id="cityName" autocomplete="off" placeholder="Въведи име" required>
                <input type="date" name="date" id="date" autocomplete="off" required>
                <div class="item_container">
                    <label id="startTime" for="startTime">Начало:</label>
                    <input type="time" name="startTime" autocomplete="off" required>
                </div>
                <div class="item_container">
                    <label id="endTime" for="endTime">Край:</label>
                    <input type="time" name="endTime" autocomplete="off" required>
                </div>
                <div class="item_container">
                    <label for="cityImage">Снимка:</label>
                    <input type="file" name="cityImage" id="cityImage" autocomplete="off" required>
                </div>
                <div class="button_container">
                    <input type="submit" name="submit" id="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>
</body>
</html>