<?php
    session_start();
    $servername = "localhost";
    $username = "helper";
    $password = "vmm_123";
    $database = "book_flights";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT CityCode,CityName,Airport,Country FROM Cities";
    $cities = $conn->query($sql);

    $conn->close();

    // Function to Create Custom UL Menu for Airport Choice
    function buildUlMenu( $cities, $OptionsList, $Option, $Airport_SelectField_TextID, $OppositeOptionsList, $Opposite_AirportSelectField_TextID )
    {
        $ulMenu = "<ul id='$OptionsList' class='$OptionsList'>"; // Open UL Menu (HTML Element)
        foreach($cities as $item) {
            $currentCityName = $item["CityName"]; // Store City Name from the current database row
            $currentCityNameUpper = strtoupper($currentCityName); // City Name Uppercase
            $currentCityAirport = $item["Airport"]; // Store City's Airport from the current database row
            // Define LI Option Element with CLASS value,ID value and ONCLICK Event function call
            $liOption = "<li class='$Option' name='$currentCityName' id='$currentCityNameUpper' onclick='onClick_MenuAirportOption(this.id,$Airport_SelectField_TextID,$OptionsList,$OppositeOptionsList,$Opposite_AirportSelectField_TextID)'>";
            // Append the LI Option Element (with the current city item from the database) to the UL Menu Element
            $ulMenu .= $liOption. "<img src='Images/airplane.png' alt='Airpline Image Image'>"."<p>$currentCityName - $currentCityAirport</p>"."</li>";
        }
        $ulMenu .= "</ul>"; // Close the UL Menu

        return $ulMenu; // Return the full UL Menu
    }
    function printFlightNotFound() {
        if(!empty($_SESSION["flightNotFound"])) // If there is flightNotFound Variable (There is no flight with the user's data)
        {
            $message = $_SESSION["flightNotFound"];
            echo "<script>alert('$message')</script>";
        } 
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Balkan Travel</title>
        <link rel="stylesheet" href="Style.css">
        <link rel="icon" href="../Images/fafiIcon.png">

    </head>
    <body>
        <button class="back" onclick="window.history.go(-1);">Back</button>
        <?php echo printFlightNotFound(); ?>

        <div class="Container_FlightForm">
            <h1>Flight Ticket Booking Form</h1>
            <form action="./PurchaseTicketPage/FindFlight.php" method="POST">                
                <!-- Menu Element for Flight From Airport Choice -->
                <div class="Menu_FromAirport">
                    <div id="SelectField_FromAirport" onclick="onClick_SelectField('OptionsList_FromAirport','OptionsList_ToAirport')">
                        <label for="SelectField_FromAirport_Text">From:</label>
                        <input type="text" name="SelectField_FromAirport_Text" id="SelectField_FromAirport_Text" placeholder="From" autocomplete="off" required>
                    </div>

                    <?php 
                        echo buildUlMenu($cities,"OptionsList_FromAirport","Option_FromAirport","SelectField_FromAirport_Text","OptionsList_ToAirport","SelectField_ToAirport_Text"); // Call Function to Create Custom UL Menu for "From Airport Choice"
                    ?>

                </div>

                <!-- Menu Element Button for Airports Choices Swap -->
                <div class="Container_SwapButton">
                    <button type="button" class="Swap_Airports" onclick="swapAirports()" alt="Swap Airports"></button> <!-- 'SelectField_FromAirport_Text','SelectField_ToAirport_Text' -->
                </div>
                
                <!-- Menu Element for Flight To Airport Choice -->
                <div class="Menu_ToAirport">
                    <div id="SelectField_ToAirport" onclick="onClick_SelectField('OptionsList_ToAirport','OptionsList_FromAirport')">
                        <label for="SelectField_ToAirport_Text">To:</label>    
                        <input type="text" name="SelectField_ToAirport_Text" id="SelectField_ToAirport_Text" placeholder="To" autocomplete="off" required>
                    </div>

                    <?php 
                        echo buildUlMenu($cities,"OptionsList_ToAirport","Option_ToAirport","SelectField_ToAirport_Text","OptionsList_FromAirport","SelectField_FromAirport_Text"); // Call Function to Create Custom UL Menu for "To Airport Choice"
                    ?>

                </div>

                <div class="Container_DepartDatePicker">
                    <label for="date">Depart Date:</label>
                    <input type="date" id="date" name="date" required min="<?php echo date("Y-m-d"); ?>">
                </div>

                <div class="Container_FlightClassChoice">
                    <label for="class">Class:</label>
                    <select id="class" name="class" required>
                        <option value="Economy">Economy</option>
                        <option value="Business">Business</option>
                        <option value="First class">First Class</option>
                    </select>
                </div>

                <div class="Container_ShowFlightsButton">
                    <button type="submit" name="Show_Flights" class="Show_Flights" alt="Show Flights">Show Flights</button>
                </div>
            </form>
        </div>
        
        <!-- Page and Elements' Scripts -->
        <script type="text/javascript" src="Scripts/Script_Slideshow.js"></script>
        <script src="Scripts/Script_AirportMenu.js" type="text/javascript"></script>
    </body>
</html>