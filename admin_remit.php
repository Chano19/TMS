<?php
$servername = "localhost";
$username = "u320585682_TMS";
$password = "Crctracking3";
$dbname = "u320585682_TMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// SQL query to get records based on specific conditions
$sql = "SELECT id, hub, SUM(price) AS amount, datetime FROM manifests WHERE hub='Batangas' AND status='Delivered'";
$result = $conn->query($sql);

// Calculate total amount based on the same conditions
$total_sql = "SELECT SUM(price) AS total_amount FROM manifests WHERE hub='Batangas' AND status='Delivered'";
$total_result = $conn->query($total_sql);
$total_amount = $total_result->fetch_assoc()['total_amount'];

$conn->close();
?>
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
    .table{
    margin-left: 80px;
      margin-top: 20px;
    }
    h4{
      margin-left: 230px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h5 class="text-center mt-2">Welcome to <br> Admin</h5>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_management.php"><i class="fas fa-users"></i> User Management</a>
    <a href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a class="active" href="admin_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a href="reportpage.php"><i class="far fa-file-alt"></i> Report</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="content">
    <div class="container">
      <div class="card">
        <div class="row">
          <div class="col-md-10">
            <h2>Report</h2>
            </form>
              <table class="table table-hover mt-3 border border-1">
                <thead class="bg-info">
                  <tr>
                    <th>Hub</th>
                    <th>Amount</th>
                    <th>Date/Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["hub"]. "</td>
                                    <td>" . $row["amount"]. "</td>
                                    <td>" . $row["datetime"]. "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No records found</td></tr>";
                    }
                  ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
        </div>
  </div>
</body>
</html>
