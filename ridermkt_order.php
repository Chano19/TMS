<?php
session_start();
include('config.php'); // Include database connection

// Define default values for search and filters
$search = "";
$filter_address = "";
$filter_status = "";

// Initialize result variable
$result = null;

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle status update
    if (isset($_POST['update_status'])) {
        $id = $_POST['id'];
        $new_status = $_POST['status'];
        $return_reason = isset($_POST['return_reason']) ? $conn->real_escape_string($_POST['return_reason']) : '';

        // Handle image upload
        $image = "";
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['image']['name'];
            $image_temp = $_FILES['image']['tmp_name'];
            $image_path = 'uploads/' . basename($image);
            
            // Make sure the uploads directory exists
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            
            // Move the uploaded file to the 'uploads' directory
            if (move_uploaded_file($image_temp, $image_path)) {
                echo "Image uploaded successfully.";
            } else {
                echo "Failed to upload image.";
            }
        }

        if ($new_status == 'Return' && $return_reason) {
            $update_sql = "UPDATE manifests SET status='$new_status', return_reason='$return_reason', image='$image' WHERE id=$id";
        } else {
            $update_sql = "UPDATE manifests SET status='$new_status', image='$image' WHERE id=$id";
        }

        if ($conn->query($update_sql) !== TRUE) {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Handle payment
    if (isset($_POST['pay'])) {
        $manifest_id = $_POST['id'];
        $amount = $_POST['amount'];
        $payment_sql = "INSERT INTO payments (manifest_id, amount) VALUES ('$manifest_id', '$amount')";
        if ($conn->query($payment_sql) !== TRUE) {
            echo "Error: " . $conn->error;
        }
    }

    // Handle search and filters
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    } else {
	$search_query = "WHERE hub='Makati' && role='Rider'";
}
 
}

// Build search query
$search_query = "WHERE 1=1";
if ($search) {
    $search = $conn->real_escape_string($search);
    $search_query .= " AND (customer_name LIKE '%$search%' OR awbnumber LIKE '%$search%' OR product_id LIKE '%$search%')";
} else {
	$search_query = "WHERE hub='Makati' && status='Assigned' || status='Delivered' || status='Cancel - First Attempt' || status='Cancel - Second Attempt' || status='Cancel - Third Attempt' || status='Return'";
}


$sql = "SELECT id, product_id, awbnumber, customer_name, hub, address, contact, seller, weight, size, price, datetime, status, image FROM manifests $search_query";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
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
    .table {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .return-reason {
      display: none;
    }
    .img-preview {
      max-width: 100px; /* Adjust as needed */
      max-height: 100px; /* Adjust as needed */
      object-fit: cover;
    }
  </style>
  <script>
    function handleStatusChange(selectElement) {
      var reasonField = document.getElementById('return-reason');
      if (selectElement.value === 'Return') {
        reasonField.style.display = 'block';
      } else {
        reasonField.style.display = 'none';
      }
    }
  </script>
</head>
<body>
  <div class="wrapper sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px" style="justify-content: center;">
    <h3 class="text-center">Welcome to Rider Hub</h3>
    <a href="ridermkt_profile.php">Profile</a>
    <a class="active" href="ridermkt_order.php">Order</a>
	<a href="ridermkt_remittance.php">Remittance</a>
    <a href="logout.php">Logout</a>
  </div>

  <section id="order">
    <div class="content">
      <div class="form-container" style="display: flex; justify-content: center; margin: 10px auto;"></div>

      <h2 class="text-center p-5">List of Parcel</h2>
      <!-- Search Form -->
      <form method="post" action="ridermkt_order.php">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search...">
        <input type="submit" class="bg-success fw-bold" name="search_btn" value="Search">
      </form><br>

      <table class="table table-sm p-5">
        <thead class="bg-info text-center fs-6">
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
				<th>Image</th>
            <th>Payment</th>
          </tr>
        </thead>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $image_path = $row["image"] ? 'uploads/' . $row["image"] : 'uploads/default.png'; // Default image if none uploaded
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
							<form method='post' action='ridermkt_order.php' enctype='multipart/form-data'>
								<input type='hidden' name='id' value='" . $row["id"] . "'>
								<select name='status' onchange='handleStatusChange(this)' data-current-status='" . $row["status"] . "' class='status-dropdown'>
									<option selected disabled>Choose...</option>
									<option value='Delivered' " . ($row["status"] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
									<option value='Cancel - First Attempt' " . ($row["status"] == 'Cancel - First Attempt' ? 'selected' : '') . ">Cancel - First Attempt</option>
									<option value='Cancel - Second Attempt' " . ($row["status"] == 'Cancel - Second Attempt' ? 'selected' : '') . ">Cancel - Second Attempt</option>
									<option value='Cancel - Third Attempt' " . ($row["status"] == 'Cancel - Third Attempt' ? 'selected' : '') . ">Cancel - Third Attempt</option>
									<option value='Return' " . ($row["status"] == 'Return' ? 'selected' : '') . ">Return</option>
								</select>
								<div id='return-reason'>
									<input type='text' name='return_reason' placeholder='Reason for return'>
								</div>
									<input type='file' name='image'>
									<input type='submit' class='bg-success' name='update_status' value='Update'>
							</form>
						</td>
						<td>
							<img src='" . $image_path . "' class='img-preview' alt='Parcel Image'>
						</td>
						<td>
							<form method='post' action='ridermkt_order.php'>
							<input type='hidden' name='id' value='" . $row["id"] . "'>
							<input type='hidden' name='amount' value='" . $row["price"] . "'>
							<input type='submit' class='bg-success' name='pay' value='Pay'>
							</form>
						</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No data found</td></tr>";
        }
        $conn->close();
        ?>
      </table>
    </div>
  </section>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all status dropdowns
        const statusDropdowns = document.querySelectorAll('.status-dropdown');

        statusDropdowns.forEach(function (dropdown) {
            const currentStatus = dropdown.getAttribute('data-current-status');

            // Disable options based on the current status
            if (currentStatus === 'Delivered') {
                dropdown.querySelector('option[value="Cancel - First Attempt"]').disabled = true;
                dropdown.querySelector('option[value="Cancel - Second Attempt"]').disabled = true;
                dropdown.querySelector('option[value="Cancel - Third Attempt"]').disabled = true;
                dropdown.querySelector('option[value="Return"]').disabled = true;
            } else if (currentStatus === 'Return') {
                dropdown.querySelector('option[value="Delivered"]').disabled = true;
                dropdown.querySelector('option[value="Cancel - First Attempt"]').disabled = true;
                dropdown.querySelector('option[value="Cancel - Second Attempt"]').disabled = true;
                dropdown.querySelector('option[value="Cancel - Third Attempt"]').disabled = true;
            } else if (currentStatus === 'Cancel - Second Attempt') {
				dropdown.querySelector('option[value="Cancel - First Attempt"]').disabled = true;
			} else if (currentStatus === 'Cancel - Third Attempt') {
				dropdown.querySelector('option[value="Cancel - First Attempt"]').disabled = true;
				dropdown.querySelector('option[value="Cancel - Second Attempt"]').disabled = true;
			}
        });
    });

    function handleStatusChange(selectElement) {
        var reasonField = selectElement.parentElement.querySelector('#return-reason');
        if (selectElement.value === 'Return') {
            reasonField.style.display = 'block';
        } else {
            reasonField.style.display = 'none';
        }
    }
</script>