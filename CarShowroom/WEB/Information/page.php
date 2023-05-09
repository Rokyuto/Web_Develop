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

    $sql = $connection->prepare("SELECT * FROM information");
    $sql->execute();
    $info = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Navbar/navbarStyle.css">
</head>
<body>
    <?php include("../Navbar/navbar.php"); ?>

    <h1>Очаквайте ни в:</h1>

    <?php foreach ($info as $currentCity) { ?>
        <div class="cityContainer">
            <div class="cityInfo">
                <div class="alignHelper">
                    <h2><?= $currentCity["CityName"] ?></h2>
                    <p>На дата: <?= $currentCity["date"] ?></p>
                    <p>Начало: <?= $currentCity["startTime"] ?> часа</p>
                    <p>Край: <?= $currentCity["endTime"] ?> часа</p>
                </div>
            </div>
            <img src="<?= $currentCity["cityImage"] ?>"  alt="<?= $currentCity["CityName"] ?>">
        </div>
    <?php } ?>
</body>
</html>