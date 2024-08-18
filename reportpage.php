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

// Set default date to today
$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// SQL query to get daily report per hub for the selected date
$report_sql = "SELECT DATE(datetime) as datetime, hub, COUNT(*) as total_parcels, SUM(price) as total_amount 
               FROM manifests 
               WHERE DATE(datetime) = '$selected_date'
               GROUP BY datetime, hub 
               ORDER BY datetime DESC, hub ASC";

$report_result = $conn->query($report_sql);

// SQL query to get total parcels, total amount, and date for each hub
$summary_sql = "SELECT hub, COUNT(*) as total_parcels, SUM(price) as total_amount, DATE(datetime) as date
                FROM manifests
                WHERE DATE(datetime) = '$selected_date'
                GROUP BY hub
                ORDER BY hub ASC";

$summary_result = $conn->query($summary_sql);
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
    <a href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a href="admin_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a class="active" href="reportpage.php"><i class="far fa-file-alt"></i> Report</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>  </div>

<div class="content"><br><br>
    <div class="container mt-5">
        <h2 class="text-center">Daily Report</h2>

        <!-- Date Filter Form -->
        <form method="get" class="text-center mb-4">
            <label for="date">Select Date: </label>
            <input type="date" id="date" name="date" value="<?php echo $selected_date; ?>">
            <button type="submit" class="btn btn-info">Filter</button>
        </form>

        <!-- Print Button -->
        <div class="text-center mb-4">
            <button onclick="printReport()" class="btn btn-primary">Print Report</button>
        </div>

        <!-- Summary by Hub Table -->
        <h3 class="text-center mt-5">Summary by Hub</h3>
        <table class="table table-hover">
            <thead class="bg-info">
                <tr>
                    <th>Hub</th>
                    <th>Total Parcels</th>
                    <th>Total Amount</th>
                    <th>Date</th> <!-- Date column -->
                </tr>
            </thead>
            <tbody>
            <?php
            if ($summary_result->num_rows > 0) {
                while($row = $summary_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["hub"]) . "</td>
                            <td>" . htmlspecialchars($row["total_parcels"]) . "</td>
                            <td>₱" . number_format($row["total_amount"], 2) . "</td>
                            <td>" . date('Y-m-d', strtotime($row["date"])) . "</td> <!-- Display Date -->
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No summary data found for the selected date</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>