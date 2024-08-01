<html>
<head>
  <title>CRC Tracking App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: white;
      background-image: url("images/crcbg.jpg");
      background-repeat: no-repeat;
      background-size: auto-sized;
      background-attachment: fixed;
    }
  </style>
</head>

<body>
<?php
  $conn=mysqli_connect('localhost','u320585682_TMS','Crctracking3','u320585682_TMS');
  include_once'navbar.php';
?>

  <!-- Home -->
<section id="home" class="">
    <div class="hero"><br><br><br><br><br><br><br><br><br><br>
    <div class="text" style="width: 90%; margin: auto;">
      <h4 style="font-size: 40px; color:black; font-weight: 500; margin-bottom: 10px;">Tracking</h4>
      <h1 style="color:black; font-size: 65px; text-transform: uppercase; line-height: 1; margin-bottom: 30px;">Management
      <span style="color:darkorange; font-size: 80px; font-weight: bold;">System</span></h1>
        <p style="color:black; margin-bottom: 30px;">Real Poise, Real Power, Real Performance.</p>
    </div>
  </div>
</section> 
  <!-- Contact -->
<div class="container">
    <section id="contact" class="py-3">
      <div class="position-relative py-5">
        <div class="position-absolute"><img alt="" class="img-fluid" src=""></div>
        <div class="position-relative">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-6">
                <div class="bg-transparent p-5 rounded shadow mt-5">
                  <h2 class="display-6 fw-bold text-center mb-4">Contact Us</h2>
                  <form action="https://api.web3forms.com/submit" method="POST" id="contactform">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
                        <input type="hidden" name="access_key" value="d2a4dc83-abd8-4ed9-afe6-8f2102c0d22e">
                          <input class="form-control bg-light" placeholder="Your name" type="text" id="name" name="name">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="mb-3">
                          <input class="form-control bg-light" placeholder="Your email" type="text" id="email" name="email">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="mb-3">
                          <textarea class="form-control bg-light" placeholder="Your message" rows="4" id="message" name="message"></textarea>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="d-grid">
                          <button class="btn btn-primary" type="submit" id="send">Send message</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
</html>

