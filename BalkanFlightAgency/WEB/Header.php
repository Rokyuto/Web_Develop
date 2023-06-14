
<?php
session_start(); // Initialize session data

$mysqli = new mysqli("localhost","helper","vmm_123","book_flights");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

if(isset($_SESSION['user'])) {
  $email = $_SESSION['user']['email'];
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = $mysqli->query($query);

  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
  } else {
    // Handle error if user not found in database
    $username = "Unknown";
  }
} else {
  $username = "Guest";
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../HomePage/HomePage.php" style="width: 25%;"><img src="../Images/Balkan-airlines-logo.png" alt="" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        <a class="nav-link active text-center" aria-current="page" href="../AboutUsPage/aboutus.php"><i class="fa-solid fa-address-card"></i> About us</a>

        <?php if (isset($_SESSION['user'])) { // If there is a session - 'user' variable has value (there is logged in user) 
        ?>
          <a class="nav-link active  text-center " aria-current="page" href="../BookFlightPages/FlightSetupPage.php"><i class="fa-solid fa-cart-shopping"></i> Buy ticket</a>

          <?php
          if ($_SESSION['user'][4] == 1) { // If the loged user is ADMIN ?>

          <div class="dropdown" >
          <a class="dropdown-toggle nav-link active text-center" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user-secret"></i> Welcome, <?= $username ?></a>
            <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
              <a class="dropdown-item text-center" aria-current="page" href="../AdminPanel/ShowFlights.php"><i class="fa-solid fa-screwdriver-wrench"></i> Admin Panel</a>
              <a class="dropdown-item text-center"  href="../AccountPage/Logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </ul>

          </div>
          
          <?php  }  else if ($_SESSION['user'][4] == 0) { // If the loged user is regular ?>

            <div class="dropdown">
              <a class="dropdown-toggle nav-link active text-center" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome to your page, <?= $username ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li class="dropdown-item text-center">Welcome to your page, <?= $username ?></li>
                <li><a class="dropdown-item text-center" href="../CheckUserFlights/Page.php"><i class="fa-solid fa-plane-circle-check"></i> Check your flights</a></li>
              
                <li><a class="dropdown-item text-center" href="../AccountPage/EditProfile.php"><i class="fa-solid fa-user-pen"></i> Edit your profile </a></li> <!-- <button type="button" class="btn btn-link" value= ($_SESSION['user'] ['email']) name="button"> -->
                <li><a class="dropdown-item text-center" aria-current="page" href="../AccountPage/Logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
              </ul>
            </div>
          <?php
          }
          ?>

        <?php
        }else{ 
        ?>
          <a class="nav-link active  text-center " aria-current="page" href="../AccountPage/LoginPage.php"><i class="fa-solid fa-cart-shopping"></i> Buy ticket</a>
          <a class="nav-link active  text-center" aria-current="page" href="../AccountPage/LoginPage.php"><i class="fa fa-fw fa-user "></i> Login</a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</nav>