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
} else {
	$search_query = "WHERE hub='Makati' && role='Rider'";
}
$sql2 = "SELECT id, name, contact FROM login $search_query";
$result2 = $conn->query($sql2);
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
    $search_query = "WHERE customer_name LIKE '%$search%' OR order_id LIKE '%$search%' OR product_id LIKE '%$search%'";
} else {
	$search_query = "WHERE address LIKE 'Makati' && status='Out for Delivery'";
}

$sql = "SELECT id, product_id, awbnumber, customer_name, address, order_id, order_description, quantity, price, total_price, remarks FROM manifests $search_query";
$result = $conn->query($sql);
?>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h5 class="text-center mt-2">Welcome to <br> Makati Hub</h5>
    <a class="mt-3" href="makatihub.php"><i class="fas fa-home"></i> Home</a>
    <a href="makati_manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a class="active" href="makati_assign.php"><i class="fas fa-user-cog"></i> Assign Riders</a>
    <a href="makati_profile.php"><i class="fas fa-user"></i> Profile Staff</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
  <div class="content">
    <h2 class="text-center p-2 mt-5">List of Parcel</h2>
    <form action="" method="POST">
      <div class="table-responsive">
	  
        <!-- Search Form -->
<form method="post" action="makati_assign.php">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search);?>" placeholder="Search...">
    <input type="submit" name="search_btn" value="Search">
</form>
	  
        <table class="table table-hover mt-2 border border-1">
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
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo '
                      <tr>
                        <td>' . $row["product_id"]. '</td>
                        <td>' . $row["awbnumber"]. '</td>
                        <td>' . $row["customer_name"]. '</td>
                        <td>' . $row["address"]. '</td>
                        <td>' . $row["order_id"]. '</td>
                        <td>' . $row["order_description"]. '</td>
                        <td>' . $row["quantity"]. '</td>
                        <td>' . $row["price"]. '</td>
                        <td>' . $row["total_price"]. '</td>
                        <td>' . $row["remarks"]. '</td>
                        <td>
                          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">Rider</button>
                        </td>
                      </tr>
                    ';
                }
              }
            ?>
          </tbody>
        </table>
      </div>
      </form>

      <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Assign Rider</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <table class="table table-hover mt-2 border border-1 text-center">
          <thead class="bg-info">
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
		<?php
              if($result2->num_rows > 0){
                while($row = $result2->fetch_assoc()) {
                    echo '
                      <tr>
                        <td>' . $row["name"]. '</td>
                        <td>' . $row["contact"]. '</td>
                        <td>
                          <button type="button" class="btn btn-info">Assign</button>
                        </td>
                      </tr>
                    ';
                }
              }
            ?>
		</tbody>
        </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
  </div>
</body>
</html>