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

$sql = "SELECT id, product_id, awbnumber, customer_name, address, order_id, order_description, quantity, price, total_price, remarks, status FROM manifests";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRC Tracking App</title>
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
<?php
// Fetch distinct addresses for the dropdown filter
$addresses_result = $conn->query("SELECT DISTINCT address FROM manifests");

// Fetch distinct statuses for the dropdown filter
$statuses_result = $conn->query("SELECT DISTINCT status FROM manifests");

$search = "";
$filter_address = "";
$filter_status = "";

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
	if (isset($_POST['filter_address'])) {
        $filter_address = $_POST['filter_address'];
    }

    if (isset($_POST['filter_status'])) {
        $filter_status = $_POST['filter_status'];
    }
}

$search_query = "WHERE 1=1";
if ($search) {
    $search = $conn->real_escape_string($search);
     $search_query .= " AND (customer_name LIKE '%$search%' OR order_id LIKE '%$search%' OR product_id LIKE '%$search%')";
}
if ($filter_address) {
    $filter_address = $conn->real_escape_string($filter_address);
    $search_query .= " AND address = '$filter_address'";
}

if ($filter_status) {
    $filter_status = $conn->real_escape_string($filter_status);
    $search_query .= " AND status = '$filter_status'";
}

$sql = "SELECT id, product_id, awbnumber, customer_name, address, order_id, order_description, quantity, price, total_price, remarks, status FROM manifests $search_query";
$result = $conn->query($sql);
?>
<body>
  <div class="wrapper sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px" style="justify-content: center;">
	<h3 class="text-center">Welcome to Admin</h3>
    <a href="admin.php">Dashboard</a>
    <a href="user_management.php">User Management</a>
    <a class="active" href="manifest.php">Manifest</a>
	<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">HUB Management</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
                <a href="batangas.php">Batangas</a>
            </li>
            <li>
                <a href="calamba.php">Calamba</a>
            </li>
            <li>
                <a href="makati.php">Makati</a>
            </li>
			<li>
                <a href="pasay.php">Pasay</a>
            </li>
        </ul>
    <a href="#contact">Contact</a>
    <a href="logout.php">Logout</a>
  </div>
  
<section id="user">
	
</section> 
  
  
  
<section id="order">
	<div class="content">
	<div class="form-container" style="display: flex; justify-content: center; margin: 10px auto;">
        <form action="manifest.php" method="post" enctype="multipart/form-data" style="width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff;">
            <h2 style="text-align: center; color: #333;">Upload Manifest</h2>
            <label for="file" style="display: block; margin-bottom: 10px; color: #555;">Manifest File (CSV):</label>
            <input type="file" id="file" name="file" accept=".csv" style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;" required><br>
            <input type="submit" name="upload_btn" style="width: 100%; padding: 10px; background-color: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer; background-color: #555;" value="Upload">
        </form>
<?php
include('config.php'); // Include database connection

if (isset($_POST['upload_btn'])) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file = $_FILES['file']['tmp_name'];

        if (($handle = fopen($file, "r")) !== FALSE) {
            // Get the first row, which contains the column headers
            $header = fgetcsv($handle, 1000, ",");

            // Prepare the SQL statement for inserting data
            $stmt = $conn->prepare("INSERT INTO manifests (product_id, awbnumber, customer_name, address, order_id, order_description, quantity, price, total_price, remarks, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Prepare the SQL statement for checking duplicates
            $checkStmt = $conn->prepare("SELECT * FROM manifests WHERE product_id = ? AND awbnumber = ? AND order_id = ?");

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Bind the data to check for duplicates
                $checkStmt->bind_param("iss", $data[0], $data[1], $data[4]);
                $checkStmt->execute();
                $result = $checkStmt->get_result();

                if ($result->num_rows == 0) {
                    // No duplicate found, proceed with insertion
                    $stmt->bind_param("issssisddss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]);
                    $stmt->execute();
                }
            }

            // Close the file
            fclose($handle);

            echo "";
        } else {
            echo "";
        }
    } else {
        echo "";
    }
}
?>
    </div>

    <h2 class="text-center p-5">List of Parcel</h2>
        <!-- Search Form -->
	<form method="post" action="manifest.php">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search);?>" placeholder="Search...">
        <select name="filter_address">
            <option selected disabled>Select Address</option>
            <?php
            if ($addresses_result->num_rows > 0) {
                while($address_row = $addresses_result->fetch_assoc()) {
                    $selected = ($filter_address == $address_row['address']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($address_row['address']) . "' $selected>" . htmlspecialchars($address_row['address']) . "</option>";
                }
            }
            ?>
        </select>
        <select name="filter_status">
            <option selected disabled>Select Status</option>
            <?php
            if ($statuses_result->num_rows > 0) {
                while($status_row = $statuses_result->fetch_assoc()) {
                    $selected = ($filter_status == $status_row['status']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($status_row['status']) . "' $selected>" . htmlspecialchars($status_row['status']) . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" name="search_btn" value="Search">
    </form><br>


     <table class="table table-hover p-4">
        <thead class="bg-info">
			<tr>
				<th>Product ID</th>
				<th>AWB Number</th>
				<th>Customer Name</th>
				<th>Address</th>
				<th>Order ID</th>
				<th>Order Description</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total Price</th>
				<th>Remarks</th>
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
            <td>" . $row["address"]. "</td>
            <td>" . $row["order_id"]. "</td>
            <td>" . $row["order_description"]. "</td>
            <td>" . $row["quantity"]. "</td>
            <td>" . $row["price"]. "</td>
            <td>" . $row["total_price"]. "</td>
            <td>" . $row["remarks"]. "</td>
            <td>
                <form method='post' action='manifest.php'>
                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                    <select name='status'>
                        <option value='Arrived at Warehouse' " . ($row["status"] == 'Arrived at Warehouse' ? 'selected' : '') . ">Arrived at Warehouse</option>
                        <option value='In-transit to Hub' " . ($row["status"] == 'In-transit to Hub' ? 'selected' : '') . ">In-transit to Hub</option>
                    </select>
                    <input type='submit' name='update_status' value='Update'>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='13'>No data found</td></tr>";
}
$conn->close();
?>
	</div>
</section>

</body>
</html>