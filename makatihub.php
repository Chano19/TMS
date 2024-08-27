<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['hub'] != 'Makati' || $_SESSION['role'] != 'Staff') {
    header('Location: loginpage.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRC Tracking App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    .sidebar {
      margin: 0;
      padding: 0;
      width: 200px;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
    }
    .sidebar a {
      display: block;
      color: black;
      padding: 16px;
      text-decoration: none;
    }
    .sidebar a.active {
      background-color: #04AA6D;
      color: white;
    }
    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }
    .content {
      margin-left: 200px;
      padding: 16px;
    }
    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      .content {margin-left: 0;}
    }
    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
    .card {
      margin: 20px 0;
      padding: 30px;
      border: 1px solid #ddd3;
      border-radius: 5px;
      background-color: rgba(255, 255, 255, 0.9);
    }
    .ords, .rides {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h5 class="text-center mt-2">Welcome to <br> Makati Hub</h5>
    <a class="active mt-3" href="makatihub.php"><i class="fas fa-home"></i> Home</a>
    <a href="makati_manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="makati_assign.php"><i class="fas fa-user-cog"></i> Assign Riders</a>
    <a href="makati_profile.php"><i class="fas fa-user"></i> Profile Staff</a>
    <a href="makati_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <button type="button" class="ords btn btn-info" onclick="location.href='makatihuborders.php'">
              <i class="fas fa-box"></i> ORDERS
            </button>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <button type="button" class="rides btn btn-info" onclick="location.href='makatirider.php'">
              <i class="fas fa-motorcycle"></i> RIDER
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>