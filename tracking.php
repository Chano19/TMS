<html>
<head>
    <title>CRC Tracking App</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
    <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
    <style>
        body {
            background-color: white;
            background-image: url("images/crcbg.jpg");
            background-repeat: no-repeat;
            background-size: auto-sized;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
<?php
    $conn=mysqli_connect('localhost','u320585682_TMS','Crctracking3','u320585682_TMS');
    include_once'navbar.php';
?>
<br><br><br><br><br>
    <h1 class="text-dark" style="text-align: center; margin-top: 20px;">Package Tracking</h1>
    <div class="form-container" style="display: flex; justify-content: space-around; margin: 20px auto;">
        <form action="result_tracking.php" method="post" class="bg-transparent shadow" style="width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff;">
            <h2 style="text-align: center; color: #333;">Search for a Package</h2>
            <label for="searchPackageId" style="display: block; margin-bottom: 1px; color: #555;">Product Id or AWB Number:</label><br>
            <input type="text" id="searchPackageId" name="searchPackageId" style="width: 100%; padding: 8px; margin-bottom: 5px; border: 1px solid #ccc; border-radius: 5px;" required><br><br>
            <input type="submit" style="width: 100%; padding: 10px; background-color: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer;" value="Search">
        </form>
    </div>
</body>
</html>
