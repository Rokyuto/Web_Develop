<?php 
    include("Ticket.php"); // Import Ticket php file

    $servername = "localhost";
    $username = "helper";
    $password = "vmm_123";
    $database = "book_flights";
    try { // Try to connect to the database
        $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) { // Catch Block for Exceptions
        echo "Connection failed: " . $e->getMessage();
    }

    $ticket = new Ticket(); // Create Ticket Object
    // Asign Ticket's Variables Value
    $ticket->set_connection($connection);
    $ticket->set_flightID($_GET['flightID']);
    $ticket->set_passager( urldecode( $_GET['passager'] ) );
    $ticket->set_gate($_GET["gate"]);
    $ticket->set_seat($_GET["seat"]);

    // Call Ticket Funtion to save the ticket in user's account
    $ticket->saveFlightInUserAccount($ticket->get_connection(),$ticket->get_passager(),$ticket->get_flightID(),$ticket->get_seat(),$ticket->get_gate());
?>