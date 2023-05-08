<?php 
    include("../Navbar/navbar.php");

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

    if(isset($_POST["submit"])){

        $sqlTestDrive = "INSERT INTO testDrive(user_id,car_id,date,time,userPhone) VALUES(?,?,?,?,?)";
        $connection->prepare($sqlTestDrive)->execute([ $_SESSION["user"]["user_id"] , $_POST["car"] , $_POST["testDriveDate"] , $_POST["testDriveTime"] , $_POST["userPhone"]]);

        echo "<script>alert('Резервирахте час за тест драйв')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test Drive</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../Navbar/navbarStyle.css">
    </head>
    <body>
        <div class="container">
            <h1>Резервирайте тест драйв:</h1>
            <form action="#" method="post">
                <select name="car" required>
                    <option value="" selected hidden>Изберете марка</option>
                    <?php foreach($cars as $car){ ?>
                        <option value="<?= $car['car_id'] ?>" ><?= $car['brand'] . " " . $car['model']?></option>
                    <?php } ?>
                </select>
                <div class="item_container">
                    <label for="testDriveDate">Изберете дата:</label>
                    <input type="date" name="testDriveDate" id="testDriveDate" required>
                </div>
                <div class="item_container">
                    <label for="testDriveTime">Изберете час:</label>
                    <input type="time" name="testDriveTime" id="testDriveTime" required>
                </div>
                <input type="tel" name="userPhone" required autocomplete="off" placeholder="Въведете вашият телефон за връзка">
                <div class="button_container">
                    <input type="submit" name="submit" id="submit" value="Submit">
                </div>
            </form>
        </div>

    </body>
</html>