<style>
    /* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

.form-container {
    display: flex;
    justify-content: space-around;
    margin: 50px auto;
}

form {
    width: 300px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fff;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}
</style>    
<!DOCTYPE html>
<html>
<head>
    <title>CRC App</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
    <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
</head>
<body>
<?php
    $conn=mysqli_connect('localhost','u320585682_TMS','Crctracking3','u320585682_TMS');
    include_once'navbar.php';
?>
<br><br><br><br>
    <h1>Package Tracking</h1>
    <div class="form-container">
        <form action="result_tracking.php" method="post">
            <h2>Search for a Package</h2>
            <label for="searchPackageId">Product ID:</label><br>
            <input type="text" id="searchPackageId" name="searchPackageId" required><br><br>
            <input type="submit" value="Search">
        </form>
    </div>
</body>
</html>