<style>
/* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

.h2 {
    text-align: center;
    color: #333;
}

.form-container {
    display: flex;
    justify-content: space-around;
    margin: 50px auto;
}

.form {
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

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-top: 20px;
}

.result {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    background-color: #fff;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.a {
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 20px;
    color: #333;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

</style>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Logitech App</title>
	<link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
	<script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
	$conn=mysqli_connect('localhost','root','','tmstrackingdelivery');
	include_once'navbar.php';
?>
<br><br><br><br>
	<h1>Package Tracking</h1>
    <div class="form-container">
        <form action="track.php" method="post">
            <h2>Track a Package</h2>
            <label for="packageId">Package ID:</label><br>
            <input type="text" id="packageId" name="packageId" required><br><br>
            <label for="status">Status:</label><br>
            <input type="text" id="status" name="status" required><br><br>
            <input type="submit" value="Track">
        </form>

        <form action="search.php" method="post">
            <h2>Search for a Package</h2>
            <label for="searchPackageId">Package ID:</label><br>
            <input type="text" id="searchPackageId" name="searchPackageId" required><br><br>
            <input type="submit" value="Search">
        </form>
    </div>
 
</body>
</html> 
