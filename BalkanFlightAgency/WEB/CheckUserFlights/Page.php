<?php 
    session_start();

    // Create connection
    try{
        $conn = new PDO('mysql:host=localhost;dbname=book_flights', 'helper', 'vmm_123');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to give all flights which the user's booked | This Query will be given with FROM Airport
        $query = $conn->prepare("SELECT * FROM Cities 
                JOIN Flights ON Cities.CityID = Flights.FromCityID
                JOIN Users ON USERS.username = ?
                JOIN userflight ON (userflight.UserID = Users.idusers AND userflight.FlightID = Flights.ID)");
        $query->execute([$_SESSION['user']["username"]]);
        $resultFROM = $query->fetchAll();

        // Query to give all flights which the user's booked | This Query will be given with TO Airport
        $query = $conn->prepare("SELECT * FROM Cities 
                JOIN Flights ON Cities.CityID = Flights.ToCityID
                JOIN Users ON USERS.username = ?
                JOIN userflight ON (userflight.UserID = Users.idusers AND userflight.FlightID = Flights.ID)");
        $query->execute([$_SESSION['user']["username"]]);
        $resultTO = $query->fetchAll();

    } catch (PDOException $e) {
        echo "Connection failed" . $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/FafiIcon.png">
    <link rel="stylesheet" href="Style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>User's Flights</title>
</head>

<body>
    <button class="back" onclick="window.history.go(-1);">Back</button>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-warning table-striped">
                <thead>
                    <tr>
                        <th scope="col">Passager</th>
                        <th scope="col">Flight Date</th>
                        <th scope="col">Depart Time</th>
                        <th scope="col">Flight Duration</th>
                        <th scope="col">Depart City</th>
                        <th scope="col">End City</th>
                        <th scope="col">Depart Airport</th>
                        <th scope="col">End Airport</th>
                        <th scope="col">Class</th>
                        <th scope="col">Price</th>
                        <th scope="col">Seat</th>
                        <th scope="col">Gate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($resultFROM) > 0) {
                        for ($currentRow=0; $currentRow < count($resultFROM); $currentRow++) {
                    ?>
                        <tr>
                            <td><?php echo $resultFROM[$currentRow]["username"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["FlightDate"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["FlightDepartTime"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["FlightDuration"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["CityName"] ?></td>
                            <td><?php echo $resultTO[$currentRow]["CityName"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["Airport"] ?></td>
                            <td><?php echo $resultTO[$currentRow]["Airport"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["FlightClass"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["FlightPrice"] ?>$</td>
                            <td><?php echo $resultFROM[$currentRow]["Seat"] ?></td>
                            <td><?php echo $resultFROM[$currentRow]["Gate"] ?></td>
                        </tr>
                    <?php }
                    } else { ?>
                        <tr>
                            <td colspan="12">No Flights</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
