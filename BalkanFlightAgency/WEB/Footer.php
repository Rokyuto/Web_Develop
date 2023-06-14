<br><br>
<footer>
  <script src="https://kit.fontawesome.com/dbf5309686.js" crossorigin="anonymous"></script>
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-6">
        <div>
          <h3 style="text-align: center;">Balkan travel</h3><br>
          <p class="mb-30 footer-desc"  style="text-align: center; font-size: meduim;">We are travel agency. We are on top of the world. We sell you the best tickets. Here you are on the right place to achieve your greatest dreams.</p>
        </div>
      </div>
      <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
        <div class="">
          <h4 style="text-align: center;">Quick Link</h4><br>
          <ul class="list-unstyled">
            <li style="text-align: center;">
              <a href="../HomePage/HomePage.php" class="text-decoration-none">Home</a><br><br>
            </li>
            <li style="text-align: center;">
              <a href="../AboutUsPage/AboutUs.php" class="text-decoration-none">About Us</a><br><br>
            </li>
            <?php if(isset($_SESSION['user'])){ ?>
              <li style="text-align: center;">
                <a href="../BookFlightPages/FlightSetupPage.php" class="text-decoration-none">Buy ticket</a>
              </li>
            <?php }else{?>
              <li style="text-align: center;">
                <a href="../AccountPage/LoginPage.php" class="text-decoration-none">Buy ticket</a>
              </li>
            <?php }?>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6"> 
      </div>

      <div class="col-xl-3 col-lg-3 col-md-6">
      
        <div>
          <h4 style="text-align: center;">Contact Us</h4><br>

          <p style="text-indent:2px !important;text-align: center;"><i class="fa-solid fa-house" style="font-size: 20px;"></i>  Perusha 4 St, Pravets </p>
          <br>
          <p style="text-indent:2px !important; text-align: center;"><i class="fa-solid fa-envelope"style="font-size: 20px;"></i></i> balkan.travel.192@gmail.com </p>
          <br>
          <p style="text-indent:2px !important;text-align: center;"><i class="fa-solid fa-phone" style="font-size: 20px;"></i>  08877346386 </p>

        </div>

      </div>
       <br>
  </div>

    <div class="d-flex justify-content-center" style="text-align: center;">
      <div class="copyright">
        <p>Developed and maintained by Mihaela Mihaylova, Viktor Asenov, Mitko Ivanov</p>
      </div>
    </div>

  </div>
</footer>