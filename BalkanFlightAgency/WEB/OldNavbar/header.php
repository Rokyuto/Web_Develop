<!-- link for jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
session_start(); // Initialize session data

$mysqli = new mysqli("localhost:3307", "helper", "vmm_123", "book_flights");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

if (isset($_SESSION['user'])) {
  $email = $_SESSION['user']['email'];
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = $mysqli->query($query);

  if ($result->num_rows > 0) {
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

<!--Start Navbar -->

<div class="mnavbar">

  <!--Start Row -->
  <div class="row">

    <div class="col-9 col-md-4">
      <img src="../Images/Balkan-airlines-logo.png" class="img-fluid" alt="">
    </div>

    <div class="col-3 col-md-8 d-flex justify-content-end">

      <button type="button" class="navbar-toggle" style="width: 50px;">
        <span><i class="fa-solid fa-bars" style=" margin-left: 18px;"></i></span>
      </button>

      <button class="navbar-btn"> <a href="../HomePage/HomePage.php"><i class="fa fa-fw fa-home"></i> Home</a></button>
      <button class="navbar-btn"><a href="../AboutUsPage/aboutus.php"><i class="fa-solid fa-address-card"></i> About Us</a></button>

      <?php if (isset($_SESSION['user'])) { // If there is a session - 'user' variable has value (there is logged in user) 
      ?>

        <button class="navbar-btn"> <a href="../BookFlightPages/FlightSetupPage.php"><i class="fa-solid fa-cart-shopping"></i> Buy ticket</a></button>

        <?php
        if ($_SESSION['user']['email'] == "admin@gmail.com") {
        ?>

          <div class="dropdown-user">
            <button class="dropbtn"><i class="fa-solid fa-user-secret"></i> <?= $username ?></button>
            <div class="dropdown-content">
              <a class="mimi" href="../AdminPanel/showFlights.php"><i class="fa-solid fa-screwdriver-wrench"></i> Admin Panel</a>
              <a class="mimi" href="../AccountPage/Logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
          </div>

        <?php
        } else {
        ?>


          <div class="dropdown-user">
            <button class="dropbtn"><i class="fa-solid fa-user-secret"></i> <?= $username ?></button>
            <div class="dropdown-content">

              <a class="mimi" href="../AccountPage/EditProfile.php"><i class="fa-solid fa-user-pen"></i> Edit your profile</a>
              <a class="mimi" href="../CheckUserFlights/Page.php"><i class="fa-solid fa-plane-circle-check"></i> Check your flights</a>
              <a class="mimi" href="../AccountPage/Logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>

            </div>
          </div>

   

  




<?php }  ?>

<?php
      } else {
?>

  <button class="navbar-btn"> <a href="../AccountPage/LoginPage.php"><i class="fa-solid fa-cart-shopping"></i> Buy ticket</a></button>
  <button class="navbar-btn"> <a href="../AccountPage/LoginPage.php"><i class="fa fa-fw fa-user "></i> Login</a></button>




<?php
      }
?>

 </div>
</div>
  <!--End  Navbar -->


<script>
  $(document).ready(function() {
    $('.navbar-toggle').click(function() {
      $('.navbar-btn').slideToggle('fast');
      $('.dropbtn').slideToggle('fast');
    });

    $(window).resize(function() {
      if ($(window).width() > 768) {
        $('.navbar-btn').removeAttr('style');
      }
      if ($(window).width() > 768) {
        $('.dropbtn').removeAttr('style');
      }
    });
  });
</script>