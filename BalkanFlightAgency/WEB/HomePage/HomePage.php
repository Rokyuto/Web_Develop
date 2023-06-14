<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Balkan travel</title>
  
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="icon" href="../Images/FafiIcon.png"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="Style.css" media="screen">
  <link rel="stylesheet" href="../Header.css"  media="screen"> 
  <link rel="stylesheet" href="../Footer.css" media="screen">

  <script src="https://kit.fontawesome.com/986211ef94.js" crossorigin="anonymous"></script>

</head>

<body>

  <?php include("../Header.php"); ?>

  <?php 
    if(!empty($_SESSION["flightNotFound"])){ // If there is flightNotFound Variable (There is no flight with the user's data)
      unset($_SESSION["flightNotFound"]); // Delete flightNotFound Variable from Session array
    } 
  ?>

  <div class="card-body" style="background-color: bisque;">
    <p class="card-text" style="text-align: center;color:black"><strong>Тake the trip of your life. </strong></p>
    <p class="card-text" style="text-align: center;color:black"><strong>Don't just sit in front of the TV and watch others have fun, feel the pleasure yourself.</strong></p>
    <p class="card-text" style="text-align: center;color:black"><strong>Taste everything, don't ask yourself what it will be, just do it.</strong></p>
    <p class="card-text" style="text-align: center;color:black"><strong></strong></p>

    <p class="card-text" style="text-align: center;"><strong>Feeling when you fly:</strong>
      <i class="fa-solid fa-face-smile" style="color: #e1145c;"></i>
      <i class="fa-solid fa-face-smile" style="color: #e1145c;"></i>
      <i class="fa-solid fa-face-smile" style="color: #e1145c;"></i>
      <i class="fa-solid fa-face-smile" style="color: #e1145c;"></i>
      <i class="fa-solid fa-face-smile" style="color: #e1145c;"></i>
      <i class="fa-solid fa-face-smile" style="color: #e1145c;"></i>
    </p>
  </div> 

  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="3500">
        <img src="../Images/Afrika.jpeg" class="d-block w-100" alt="..." style="height: auto; width:100%;">
        <div class="carousel-caption d-none d-md-block">
          <h2> You want to choose a desired destination?</h2>
          <p style="font-size: 18px;">Make the trip of your life. You have the opjportunity to do it right now</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3500">
      <img src="../Images/Dubai.png" class="d-block w-100" alt="..." style="height: auto; width:100%;">
      <div class="carousel-caption d-none d-md-block ">
        <h2> You want to choose a desired destination?</h2>
        <p>Make the trip of your life. You have the opportunity to do it right now</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3500">
      <img src="../Images/Monaco.png" class="d-block w-100" alt="..." style="height: auto; width:100%;">
      <div class="carousel-caption d-none d-md-block">
        <h2> You want to choose a desired destination?</h2>
        <p>Make the trip of your life. You have the opportunity to do it right now</p>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  
  <?php include("../Footer.php"); ?>
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
