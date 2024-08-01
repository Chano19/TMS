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
$sql2 = "SELECT id, name, contact, email FROM login $search_query";
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
    if (isset($_POST['assign_rider'])) {
        $parcel_id = $_POST['parcel_id'];
        $rider_email = $_POST['assign_rider'];

        $rider_query = "SELECT name FROM login WHERE email='$rider_email'";
        $rider_result = $conn->query($rider_query);
        if ($rider_result->num_rows > 0) {
            $rider_row = $rider_result->fetch_assoc();
            $status = $rider_row['name'];

            $assign_sql = "UPDATE manifests SET status='$status' WHERE id='$parcel_id'";
            if ($conn->query($assign_sql) === TRUE) {
                echo "Rider assigned successfully!";
            } else {
                echo "Error assigning rider: " . $conn->error;
            }
        } else {
            echo "Rider not found!";
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
  $search_query = "WHERE hub LIKE 'Batangas' && status='Out for Delivery'";
}

$sql = "SELECT id, product_id, awbnumber, customer_name, hub, address, contact, seller, weight, size, price, datetime FROM manifests $search_query";
$result = $conn->query($sql);
?>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h5 class="text-center mt-2">Welcome to <br> Batangas Hub</h5>
    <a class="mt-3" href="batangashub.php"><i class="fas fa-home"></i> Home</a>
    <a href="batangas_manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a class="active" href="batangas_assign.php"><i class="fas fa-user-cog"></i> Assign Riders</a>
    <a href="batangas_profile.php"><i class="fas fa-user"></i> Profile Staff</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
  <div class="content">
    <h2 class="text-center p-2 mt-5">List of Parcel</h2>
    <form action="" method="POST">
      <div class="table-responsive">
    
        <!-- Search Form -->
        <form method="post" action="batangas_assign.php">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search);?>" placeholder="Search...">
            <input type="submit" name="search_btn" value="Search">
        </form>
    
        <table class="table table-hover mt-2 border border-1">
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
                        <td>' . $row["hub"]. '</td>
            <td>' . $row["address"]. '</td>
            <td>' . $row["contact"]. '</td>
            <td>' . $row["seller"]. '</td>
            <td>' . $row["weight"]. '</td>
            <td>' . $row["size"]. '</td>
            <td>' . $row["price"]. '</td>
            <td>' . $row["datetime"]. '</td>
                        <td>
                          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal" data-parcel-id="' . $row["id"] . '">Rider</button>
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
        <form method="POST" action="dashboard.php">
          <input type="hidden" id="parcelId" name="parcel_id">
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
                            <button type="submit" name="assign_rider" class="btn btn-info" value="' . $row["email"] . '">Assign</button>
                          </td>
                        </tr>
                      ';
                  }
                }
              ?>
            </tbody>
          </table>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
  </div>
  <script>
    var myModal = document.getElementById('myModal');
    myModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var parcelId = button.getAttribute('data-parcel-id');
      var modal = myModal;
      modal.querySelector('#parcelId').value = parcelId;
    });
  </script>
</body>
</html>
