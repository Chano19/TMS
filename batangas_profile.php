<?php
session_start();
include('config.php'); // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Get the logged-in user's email from the session
$email = $_SESSION['email'];

// Query to fetch user details from the database
$query = $conn->prepare("SELECT name, address, contact, email FROM login WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 1) {
    // Fetch the user details
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRC Tracking App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
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
    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }
    div.container {
      margin-left: 200px;
      padding: 1px 16px;
      height: 1000px;
      background-color: transparent;
    }
    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
    .sidebar a {float: left;}
      div.container {margin-left: 0;}
    }
    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
    .button{
      margin-left: 65px;
    }
    .modal-title{
      margin-left: 150px;
    }
    .buttonup{
      background-color: red;
    }
    .info{
      border-radius: 100px;
    }
</style>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h5 class="text-center mt-2">Welcome to <br> Batangas Hub</h5>
    <a class="mt-3" href="batangashub.php"><i class="fas fa-home"></i> Home</a>
    <a href="batangas_manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="batangas_assign.php"><i class="fas fa-user-cog"></i> Assign Riders</a>
    <a class="active" href="batangas_profile.php"><i class="fas fa-user"></i> Profile Staff</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
  
  <div class="container p-5">
    <div class="row">
      <div class="col-md-3">
       <img src="images/girlicon.jpg" class="img-fluid rounded-pill p-3 mt-4" width="300px" alt="CRC">
      </div>
      <div class="col-md-4">
            <h2 class="mt-4">My Profile</h2>
            <h6 class="mt-4">Name: <?php echo htmlspecialchars($user['name']); ?></h6>
            <h6>Address: <?php echo htmlspecialchars($user['address']); ?></h6>
            <h6>Contact No: <?php echo htmlspecialchars($user['contact']); ?></h6>
            <h6>Email: <?php echo htmlspecialchars($user['email']); ?></h6>
        </div>
    </div>
    <div class="row">
      <div class="button">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">Edit Profile</button>
      </div>
    </div>
  </div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Staff Information</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
          </div>
          <div class="form-group">
            <label>Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
          </div>
           <div class="form-group">
            <label>Contact No.:</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>">
          </div>
           <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Update</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>