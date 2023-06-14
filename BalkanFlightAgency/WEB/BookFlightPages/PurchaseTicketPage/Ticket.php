<?php 
    class Ticket{

        public $connection;
        public $flightID;
        public $passager;
        public $seat;
        public $gate;
        public $class;

        function set_connection($connection) {
            $this->connection = $connection;
        }
        function get_connection() {
            return $this->connection;
        }
        function set_flightID($flightID) {
            $this->flightID = $flightID;
        }
        function get_flightID() {
            return $this->flightID;
        }
        function set_passager($passager) {
            $this->passager = $passager;
        }
        function get_passager() {
            return $this->passager;
        }
        function set_seat($seat) {
            $this->seat = $seat;
        }
        function get_seat() {
            return $this->seat;
        }
        function set_gate($gate) {
            $this->gate = $gate;
        }
        function get_gate() {
            return $this->gate;
        }
        function set_class($class) {
            $this->class = $class;
        }
        function get_class() {
            return $this->class;
        }

        // Funtion to retrieve Flight Data from the Database based on User Flight Input/Setup
        function retrieveFlightData($connection,$fromAirport,$toAirport,$departDate,$flightClass){
            $queryFromCity = $connection->prepare("SELECT * FROM Cities WHERE CityName = ?"); // Query Template / Statement
            $queryFromCity->execute([$fromAirport]); // Execute the Query with the given City on "?" place
            $resultFromCity = $queryFromCity->fetch(); // Fetch (Search and Return) for Results

            $queryToCity = $connection->prepare("SELECT * FROM Cities WHERE CityName = ?"); // Query Template / Statement
            $queryToCity->execute([$toAirport]); // Execute the Query with the given City "?" place
            $resultToCity = $queryToCity->fetch(); // Fetch (Search and Return) for Results
            
            $queryFlight = $connection->prepare("SELECT * FROM flights WHERE FromCityID = ? AND ToCityID = ? AND FlightDate = ? AND FlightClass = ?"); // Query Template / Statement
            $queryFlight->execute([ $resultFromCity["CityID"], $resultToCity["CityID"], $departDate, $flightClass]); // Execute the Query with the given FromCityID, ToCityID, DepartDate and FlightClass on "?" place
            $resultFlight = $queryFlight->fetch(); // Fetch (Search and Return) for Results

            $resultPrice = $resultFlight["FlightPrice"]; // Fetch (Search and Return) for Results

            return [$resultFromCity,$resultToCity,$resultFlight,$resultPrice]; // Return Array with all results
        }

        // Funtion to generate Random Number in [1-$endPoint] Range
        function generateRandomNumber($endPoint){
            return rand(1,$endPoint);
        }

        // Funtion to generate UPPER CASE random CHAR in [A-F] range
        function generateRandomChar(){
            return strtoupper(substr(str_shuffle(str_repeat("abcdef", 1)), 0, 1));
        }

        // Funtion to write flight data and user's id in userflight table (to save the flight in the user's account)
        function saveFlightInUserAccount($connection,$user,$flightID,$seat,$gate){
            $getUserIdQuery = $connection->prepare("SELECT idusers FROM users WHERE username = ?"); // Select query to get user's id
            $getUserIdQuery->execute([$user]); // Execute the query by giving username as parameter
            $userID = $getUserIdQuery->fetch(); // Fetch (Search) for results

            $insertUserIdQuery = $connection->prepare("INSERT INTO userflight(UserID,FlightID,Seat,Gate) VALUES(?,?,?,?)"); // Insert Query to save the flight data into user's account
            $insertUserIdQuery->execute([$userID[0],$flightID,$seat,$gate]); // Execute the query by giving parameters (UserId, FlightID, Seat,Gate)
        }
    }
?>