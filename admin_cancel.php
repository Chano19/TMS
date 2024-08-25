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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $new_status = $_POST['status'];

    $update_sql = "UPDATE manifests SET status='$new_status' WHERE id=$id";
    if ($conn->query($update_sql) === TRUE) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}

$sql = "SELECT id, product_id, awbnumber, customer_name, hub, address, contact, seller, weight, size, price, datetime, status FROM manifests";
$result = $conn->query($sql);
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
	.table{
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<?php
// Function to get parcel count for a given location
function getParcelCount($conn, $location) {
    $query = $conn->prepare("SELECT COUNT(*) as total_parcels FROM manifests WHERE status LIKE ?");
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
$delivered_count = getParcelCount($conn, 'Delivered');
$cancel_count = getParcelCount($conn, 'Cancel');
$return_count = getParcelCount($conn, 'Return');

$search = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        $id = $_POST['id'];
        $new_status = $_POST['status'];

        $update_sql = "UPDATE manifests SET status='$new_status' WHERE id=$id";
        if ($conn->query($update_sql) === TRUE) {
            echo "";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    }
}

$search_query = "";
if ($search) {
    $search = $conn->real_escape_string($search);
    $search_query = "WHERE customer_name LIKE '%$search%' OR awbnumber LIKE '%$search%' OR product_id LIKE '%$search%'";
} else {
	$search_query = "WHERE status LIKE 'Cancel%'";
}

$sql = "SELECT id, product_id, awbnumber, customer_name, hub, address, contact, seller, weight, size, price, datetime, status FROM manifests $search_query";
$result = $conn->query($sql);
?>
<body>
  <div class="wrapper sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px" style="justify-content: center;">
	<h3 class="text-center">Welcome to Admin</h3>
    <a class="active" href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_management.php"><i class="fas fa-users"></i> User Management</a>
    <a href="user_list.php"><i class="fas fa-list"></i> User List</a>
    <a href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a href="admin_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a href="reportpage.php"><i class="far fa-file-alt"></i> Report</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
 
<div class="content"><br><br>
    <div class="container" style="display: flex; flex-direction: row;">
        <main style="flex: 1; padding: 1rem;">
            <section class="cards" style="display: flex; gap: 1rem;">
                <div class="card bg-success p-2 text-center" style="flex: 1;">
                    <h2>Delivered</h2>
                    <h5>Total Parcel: <?php echo $delivered_count; ?></h5><br>
                    <a class="text-white" href="admin_delivered.php">See parcel</a>
                </div>
                <div class="card bg-danger p-2 text-center" style="flex: 1;">
                    <h2>Cancel</h2>
                    <h5>Total Parcel: <?php echo $cancel_count; ?></h5><br>
                    <a class="text-white" href="admin_cancel.php">See parcel</a>
                </div>
                <div class="card bg-warning p-2 text-center" style="flex: 1;">
                    <h2>Return</h2>
                    <h5>Total Parcel: <?php echo $return_count; ?></h5><br>
                    <a class="text-white" href="admin_return.php">See parcel</a>
                </div>
            </section>
        </main>
    </div>

<section id="manifest">
    <h2 class="text-center p-5">List of Cancel</h2>
    <form action="" method="POST">

        <!-- Search Form -->
<form method="post" action="admin_cancel.php">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search);?>" placeholder="Search...">
    <input type="submit" class="bg-success fw-bold" name="search_btn" value="Search">
</form><br>

      <table class="table table-hover p-4">
        <thead class="bg-info">
          <tr>
            <th>Product ID</th>
            <th>AWB Number</th>
            <th>Customer Name</th>
            <th>Hub</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Seller</th>
            <th>Weight</th>
            <th>Size</th>
            <th>Price</th>
            <th>Date/Time</th>
            <th>Status</th>
          </tr>
        </thead>
          <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["product_id"]. "</td>
                            <td>" . $row["awbnumber"]. "</td>
                            <td>" . $row["customer_name"]. "</td>
                            <td>" . $row["hub"]. "</td>
                            <td>" . $row["address"]. "</td>
                            <td>" . $row["contact"]. "</td>
                            <td>" . $row["seller"]. "</td>
                            <td>" . $row["weight"]. "</td>
                            <td>" . $row["size"]. "</td>
                            <td>" . $row["price"]. "</td>
                            <td>" . $row["datetime"]. "</td>
                            <td>" . $row["status"]. "</td>
                        </tr>";
                }
    } else {
        echo "<tr><td colspan='13'>No data found</td></tr>";
    }
    $conn->close();
    ?>
    </form>
  </div>
</section>
</body>
</html>