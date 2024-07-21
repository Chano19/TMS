<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('Location: loginpage.php');
    exit();
}
?>
<html>
<head>
  <title>CRC App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>

</head>

<body>
  <?php
	$conn=mysqli_connect('localhost','u320585682_TMS','Crctracking3','u320585682_TMS');
	include_once'sidebar.php';
?>



  

</body>
</html>

