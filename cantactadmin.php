<?php
$servername = "localhost";
$email = "u320585682_TMS";
$password = "Crctracking3";
$dbname = "u320585682_TMS";

// Create connection
$conn = new mysqli($servername, $email, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tblcontact";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manifest</title>
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
    div.content {
      margin-left: 200px;
      padding: 1px 16px;
      height: 1000px;
    }
    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}
    }
    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
    .table{
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
    <h3 class="text-center">Welcome to Admin</h3>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_management.php"><i class="fas fa-users"></i> User Management</a>
    <a href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a class="active" href="cantactadmin.php"><i class="fas fa-address-book"></i> Message</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
  <div class="content">
      <div class="container">
        </form>


      <table class="table table-hover mt-3 border border-1">
        <thead class="bg-info">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
          </tr>
        </thead>
          <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["name"]. "</td>
                            <td>" . $row["email"]. "</td>
                            <td>" . $row["message"]. "</td>
                        </tr>";
                }
    } 
    ?>
    </form>
      </div>
  </div>
</body>
</html>
