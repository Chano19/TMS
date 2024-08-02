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
// Fetch distinct addresses for the dropdown filter
$addresses_result = $conn->query("SELECT DISTINCT hub FROM manifests");

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
     $search_query .= " AND (customer_name LIKE '%$search%' OR awbnumber LIKE '%$search%' OR product_id LIKE '%$search%')";
}
if ($filter_address) {
    $filter_address = $conn->real_escape_string($filter_address);
    $search_query .= " AND hub LIKE '$filter_address'";
}

if ($filter_status) {
    $filter_status = $conn->real_escape_string($filter_status);
    $search_query .= " AND status = '$filter_status'";
}

$sql = "SELECT id, product_id, awbnumber, customer_name, hub, address, contact, seller, weight, size, price, datetime, status FROM manifests $search_query";
$result = $conn->query($sql);
?>
<body>
  <div class="wrapper sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px" style="justify-content: center;">
    <h3 class="text-center">Welcome to Admin</h3>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_management.php"><i class="fas fa-users"></i> User Management</a>
    <a class="active" href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a href="admin_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
  
<section id="order">
    <div class="content">
    <div class="form-container" style="display: flex; justify-content: center; margin: 10px auto;">
        <form action="manifest.php" method="post" enctype="multipart/form-data" style="width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: rgba(255, 255, 255, 0.8); box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <h2 style="text-align: center; color: #333;">Upload Manifest</h2>
            <label for="file" style="display: block; margin-bottom: 10px; color: #555;">Manifest File (CSV):</label>
            <input type="file" id="file" name="file" accept=".csv" style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;" required><br>
            <input type="submit" class="bg-info" name="upload_btn" style="width: 100%; padding: 10px; background-color: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer; background-color: #555;" value="Upload">
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
            $stmt = $conn->prepare("INSERT INTO manifests (product_id, awbnumber, customer_name, hub, address, contact, seller, weight, size, price, datetime, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Prepare the SQL statement for checking duplicates
            $checkStmt = $conn->prepare("SELECT * FROM manifests WHERE product_id = ? AND awbnumber = ?");

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Bind the data to check for duplicates
                $checkStmt->bind_param("ss", $data[0], $data[1]);
                $checkStmt->execute();
                $result = $checkStmt->get_result();

                if ($result->num_rows == 0) {
                    // No duplicate found, proceed with insertion
                    $stmt->bind_param("sssssdsssdds", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]);
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
            <!-- Static options -->
        <option value="Batangas" <?php echo ($filter_address == 'Batangas') ? 'selected' : ''; ?>>Batangas</option>
        <option value="Calamba" <?php echo ($filter_address == 'Calamba') ? 'selected' : ''; ?>>Calamba</option>
        <option value="Makati" <?php echo ($filter_address == 'Makati') ? 'selected' : ''; ?>>Makati</option>
        <option value="Pasay" <?php echo ($filter_address == 'Pasay') ? 'selected' : ''; ?>>Pasay</option>
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
            <td>
                <form method='post' action='manifest.php'>
                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                    <select name='status'>
                        <option value='Arrived at Warehouse' " . ($row["status"] == 'Arrived at Warehouse' ? 'selected' : '') . ">Arrived at Warehouse</option>
                        <option value='In-transit to Hub' " . ($row["status"] == 'In-transit to Hub' ? 'selected' : '') . ">In-transit to Hub</option>
                    </select>
                    <input type='submit' class='bg-success' name='update_status' value='Update'>
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