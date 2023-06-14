<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=book_flights', 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id = $_GET["id"];

  $sql = "SELECT FlightDate, FlightDepartTime,FlightDuration,FromCityID,ToCityID,FlightClass,FlightPrice FROM flights WHERE id = $id";
  $result = $conn->query($sql);
  $row = $result->fetch();

  $FlightDate = $row["FlightDate"];
  $FlightDepartTime = $row["FlightDepartTime"];
  $FlightDuration = $row["FlightDuration"];
  $FromCityID = $row['FromCityID'];
  $ToCityID = $row['ToCityID'];
  $FlaghtClass = $row['FlightClass'];
  $FlightPrice = $row['FlightPrice'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Form Data
    $FlightDate = $_POST["FlightDate"];
    $FlightDepartTime = $_POST["FlightDepartTime"];
    $FlightDuration = $_POST["FlightDuration"];
    $FromCityID = $_POST['FromCityID'];
    $ToCityID = $_POST['ToCityID'];
    $FlightClass = $_POST['FlightClass'];
    $FlightPrice = $_POST['FlightPrice'];

    $sql = "UPDATE flights SET FlightDate='$FlightDate', FlightDepartTime='  $FlightDepartTime', FlightDuration='$FlightDuration',FromCityID='$FromCityID',ToCityID='$ToCityID',FlightClass='$FlightClass', FlightPrice='$FlightPrice' WHERE id=$id";
    if ($conn->query($sql) == TRUE) {

      header('Location: ShowFlights.php');
      exit();
    } else {
      echo "Error updating record: " . $conn->$error;
    }
  }

  $conn = null;
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
  <title>Edit Flight</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="EditFlightsStyle.css">
  <link rel="icon" href="../Images/FafiIcon.png">
</head>

<body>
  <div class="center">
    <h1>Update your flight</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id"; ?>" method="post">
      <div class="txt_field">
        <input type="date" name="FlightDate" required value="<?php echo $FlightDate; ?>">
        <span></span>
        <label>FlightDate</label>
      </div>

      <div class="txt_field">
        <input type="time" name="FlightDepartTime" required value="<?php echo $FlightDepartTime; ?>">
        <span></span>
        <label>FlightDepartTime</label>
      </div>

      <div class="txt_field">
        <input type="time" name="FlightDuration" required value="<?php echo $FlightDuration; ?>">
        <span></span>
        <label>FlightDuration</label>
      </div>
      
      <?php
      $conn = new PDO('mysql:host=localhost;dbname=book_flights', 'root', '');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM cities";
      $result1 = $conn->query($sql);
      $rows = $result1->fetchAll();
      ?>

      From City: <select name="FromCityID" required>
        <?php
        foreach ($rows as $row) {
        ?>
          <option value="<?= $row['CityID'] ?>"><?= $row['CityName'] ?></option>
        <?php
        }
        ?>
      </select>
      <br><Br>

      To City: <select name="ToCityID" required>
        <?php
        foreach ($rows as $row) {
        ?>
          <option value="<?= $row['CityID'] ?>"><?= $row['CityName'] ?></option>
        <?php
        }
        ?>
      </select>
      <br><br>      

      Choose class of flight: <select name="FlightClass" required>

      <option value="Economy">Ecomony</option>
      <option value="Business">Business</option>
      <option value="First Class">First Class</option>
   
      </select>
      <br><br>

      <label for="FlightPrice">FlightPrice:</label>
      <input type="number" name="FlightPrice" id="FlightPrice" min="10" required autocomplete="off" value="<?= $FlightPrice; ?>"><br><br>

      <div class="pass"></div>
      <input type="submit" name="submit" value="Update">
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
