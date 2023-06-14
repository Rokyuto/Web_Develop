<?php 
    $servername = "localhost";
    $username = "helper";
    $password = "vmm_123";
    $database = "book_flights";
    session_start();
    try { // Try to connect to the database
        $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) { // Catch Block for Exceptions
        echo "Connection failed: " . $e->getMessage();
    }

    if ( isset( $_POST['Show_Flights'] ) ) { // If Show Flights Button is clicked
        // Flight Setup Data
        $fromAirport = $_POST['SelectField_FromAirport_Text'];  
        $toAirport = $_POST['SelectField_ToAirport_Text'];
        $departDate = $_POST['date'];
        $flightClass = $_POST['class'];

        include("Ticket.php"); // Import Ticket file to be able to use his funtions

        $ticket = new Ticket(); // Create new Ticket Object
        // Call Ticket Function to Retrieve Flight Data from Database and assign it to $retrievedData variable
        $retrievedData = $ticket->retrieveFlightData($connection,$fromAirport,$toAirport,$departDate,$flightClass);

        if(! $retrievedData[3]){ // If Ticket Price Not Found (there is no flight with this data)
            $_SESSION['flightNotFound'] = 'Flight not found'; // Create flightNotFound Variable for Session array
            header("location: ../FlightSetupPage.php"); // Redirect to flight setup page
        }
        else{
            unset($_SESSION['flightNotFound']); // Delete flightNotFound Variable from Session array
            // Asign Ticket's Variables Value
            $ticket->set_passager($_SESSION['user'][1]); // Assign the user's username
            $ticket->set_seat($ticket->generateRandomNumber(30) . $ticket->generateRandomChar());
            $ticket->set_gate($ticket->generateRandomNumber(10));
            $ticket->set_flightID($retrievedData[2]["ID"]);
            $ticket->set_class($retrievedData[2]["FlightClass"]);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Ticket</title>
        <link rel="stylesheet" href="Style.css">
        <link rel="icon" href="../../Images/FafiIcon.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    </head>
    <body>
        <button class="back" onclick="window.history.go(-1);">Back</button>
        <div class="FlightInfoContainer">
            <h1>Flight Ticket Information</h1>
            <br>
            <p class="FlightID">Flight №: <?php echo $ticket->get_flightID(); ?></p>
            <p class="FromCity">Depart City: <?php echo $retrievedData[0]["CityCode"] . " , " . $retrievedData[0]["CityName"]; ?></p>
            <p class="ToCity">End City: <?php echo $retrievedData[1]["CityCode"] . " , " . $retrievedData[1]["CityName"]; ?></p>  
            <p class="Passager"> Passager: <?php echo $ticket->get_passager(); ?></p>
            <p class="Seat">Seat: <?php echo $ticket->get_seat(); ?></p>
            <p class="Gate">Gate: <?php echo $ticket->get_gate(); ?></p>
            <p class="Depart">Depart Time: <?php echo date('H:i',strtotime($retrievedData[2]["FlightDepartTime"])) . " , " . $retrievedData[2]["FlightDate"]; ?></p>
            <p class="Class">Class: <?php echo $ticket->get_class(); ?></p>
            <br>
            <button type="button" class="order" value="Order" name="order" id="order">Order</button>
        </div>
        
        <!-- Click Event Script for Order Button -->
        <script>
        $(document).ready(function(){
        $("#order").click(function(){ // On click
            // AJAX | Call php file, which will call the Funtion to save the Flight in the User's Account, with giving the flight's data as parameters in the link (url)
            $.ajax({url: "BookTicketOnOrderButtonClick.php?flightID=<?= $ticket->get_flightID() ?>&passager=<?= urlencode($ticket->get_passager()) ?>&seat=<?= $ticket->get_seat() ?>&gate=<?= $ticket->get_gate() ?>", success: function(){ // connection=$connection
                alert('Ticket Booked'); // Send Alert on success
            }});
        });
        });
        </script>
           
    </body>
</html>