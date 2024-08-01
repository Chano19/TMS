<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRC App</title>
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
      background-size: 1800px 900px;
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
      font-family: "Times New Roman", Times, serif;
      margin-top: 30px;
    }
    .ords {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .report{
      border-radius: 20px;
    }
    .send{
      margin-top: 3px;
      margin-left: 750px;
    }
    .table{
      margin-top: 20px;
    }
    h4{
      text-align: left;
      margin-left: 900px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h3 class="text-center">Welcome to Rider Hub</h3>
    <a href="rider_profile.php">Profile</a>
    <a href="batangas_rider.php">Order</a>
	<a class="active" href="reportpage.php">Report</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="content">
    <div class="container">
      <div class="card">
        <div class="row">
          <div class="col-md-10">
            <h2>Report</h2>
            <textarea class="report" name="comments" rows="5" cols="100" placeholder="Write your comments here..." maxlength="600"></textarea>
          </div>
        </div>
        <div class="col-md-4">
          <button class="send">Report</button>
        </div>
      </div>
        </div>
  </div>
</body>
</html>
