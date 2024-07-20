<html>
<head>
  <title>CRC App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: white;
      background-image: url("");
      background-repeat: no-repeat;
      background-size: 1400px 1000px;
    }
  </style>
</head>

<body>
<?php
	$conn=mysqli_connect('localhost','root','','tmstrackingdelivery');
	include_once'navbar.php';
?>

	<section id="home" class=""><br><br>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/pngtree-mobile-based-delivery-service-a-3d-render-concept-with-order-tracking-image_3607142.jpg" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/logistics-apps-with-tracking-system-for-delivery-og.jpg" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/things-to-consider-when-choosing-a-gps-vehicle-tracking-solution.jpg" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
    </div>
	<!-- Home -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: transparent;">
      <div class="container">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-4 display-3 text-dark fw-bold ls-tight">
              Tracking Management System <br />
            </h1>
            <p class="text-dark">
              A Tracking Management System is a software solution designed to streamline and optimize the operations of warehouses and distribution centers. It leverages web technologies to provide users with a centralized platform for managing inventory, shipments, and tracking. 
            </p>
          </div>
        </div>
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
                <div class="bg-white p-5 rounded shadow mt-5">
                  <h2 class="display-6 fw-bold text-center mb-4">Contact Us</h2>
                  <form action="contact.php" method="POST" id="contactform">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
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

