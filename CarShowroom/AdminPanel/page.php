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
</head>
<body>
    <div class="form">
        <form action="#" method="post">
            <h1>Add Car</h1>
            <div class="container">
                <input type="text" name="brand" id="brand" autocomplete="off" placeholder="Enter Car Brand" required>
                <input type="text" name="model" id="model" autocomplete="off" placeholder="Enter Car Model" required>
                <input type="color" name="color" id="color" autocomplete="off" placeholder="Enter Car Color" required>
                <input type="number" name="price" id="price" autocomplete="off" placeholder="Enter Car Price" min="500" required>
                <input type="number" name="horsePower" id="horsePower" autocomplete="off" min="1" placeholder="Enter Car Horse Power" required>
                <input type="year" name="year" id="year" autocomplete="off" placeholder="Enter Car Year" min="<?php echo date("Y-m-d"); ?>" required>
            </div>
            <div class="image_container">
                <label for="carImage">Car Image:</label>
                <input type="file" name="carImage" id="carImage" autocomplete="off" placeholder="Enter Car Image" required>
            </div>
            <div class="button_container">
                <input type="submit" name="submit" id="submit" value="Submit">
            </div>
        </form>
    </div>
    <div>
        <form action="#" method="post">
            <header>Add City</header>
            
        </form>
    </div>
</body>
</html>