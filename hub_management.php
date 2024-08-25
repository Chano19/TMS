<?php
session_start();
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

// Function to get parcel count for a given location
function getParcelCount($conn, $location) {
    $query = $conn->prepare("SELECT COUNT(*) as total_parcels FROM manifests WHERE hub LIKE ?");
    $location_param = "%$location%";
    $query->bind_param("s", $location_param);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_parcels'];
    } else {
        return 0;
    }
}

// Get parcel counts for each location
$batangas_count = getParcelCount($conn, 'Batangas');
$calamba_count = getParcelCount($conn, 'Calamba');
$makati_count = getParcelCount($conn, 'Makati');
$pasay_count = getParcelCount($conn, 'Pasay');

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRC Tracking App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
  </style>
</head>
<body>
  <div class="wrapper sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px" style="justify-content: center;">
    <h3 class="text-center">Welcome to Admin</h3>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_management.php"><i class="fas fa-users"></i> User Management</a>
    <a href="user_list.php"><i class="fas fa-list"></i> User List</a>
    <a href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a class="active" href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a href="admin_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a href="reportpage.php"><i class="far fa-file-alt"></i> Report</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

<div class="content"><br><br>
    <div class="container justify-content-center" style="display: flex; flex-direction: row;">
        <main style="flex: ; padding: 1rem;">
            <section class="cards" style="display: flex; gap: 1rem;">
                <div class="card-row">
                <div class="card bg-primary p-4 text-center" style="flex: 1; width: 23rem;">
                    <h2>Batangas</h2>
                    <h5>Total Parcel: <?php echo $batangas_count; ?></h5><br>
                    <a class="text-white" href="batangas.php">See parcel</a>
                </div><br><br>
                <div class="card bg-danger p-4 text-center" style="flex: 1;">
                    <h2>Calamba</h2>
                    <h5>Total Parcel: <?php echo $calamba_count; ?></h5><br>
                    <a class="text-white" href="calamba.php">See parcel</a>
                </div>
                </div><br>
                <div class="card-row">
                <div class="card bg-success p-4 text-center" style="flex: 1; width: 23rem;">
                    <h2>Makati</h2>
                    <h5>Total Parcel: <?php echo $makati_count; ?></h5><br>
                    <a class="text-white" href="makati.php">See parcel</a>
                </div><br><br>
                <div class="card bg-warning p-4 text-center" style="flex: 1;">
                    <h2>Pasay</h2>
                    <h5>Total Parcel: <?php echo $pasay_count; ?></h5><br>
                    <a class="text-white" href="pasay.php">See parcel</a>
                </div>
                </div>
            </section>
        </main>
    </div>
</div>
</body>
</html>