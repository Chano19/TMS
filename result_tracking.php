<?php

// Create connection
$conn = new mysqli('localhost','u320585682_TMS','Crctracking3','u320585682_TMS');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if search form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $searchPackageId = htmlspecialchars($_POST['searchPackageId']);
    
    // Prepare and bind
    $stmt = $conn->prepare("SELECT product_id, customer_name, address, order_description, quantity, price, total_price, status FROM manifests WHERE product_id = ?");
    $stmt->bind_param("s", $searchPackageId);
    
    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
</head>

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

a {
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

<body>
    <h1>Search Result</h1>
    <div class="container">
        <?php
        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='result'>
                        <p><strong>Product ID:</strong> " . $row["product_id"] . "</p>
                        <p><strong>Customer Name:</strong> " . $row["customer_name"] . "</p>
                        <p><strong>Address:</strong> " . $row["address"] . "</p>
                        <p><strong>Order Description:</strong> " . $row["order_description"] . "</p>
                        <p><strong>Quantity:</strong> " . $row["quantity"] . "</p>
                        <p><strong>Price:</strong> " . $row["price"] . "</p>
                        <p><strong>Total Price:</strong> " . $row["total_price"] . "</p>
                        <p><strong>Status:</strong> " . $row["status"] . "</p>
                      </div>";
            }
        } else {
            echo "<p>No package found with ID: " . htmlspecialchars($searchPackageId) . "</p>";
        }
        ?>
        <a href="tracking.php">Back to Tracking</a>
    </div>
</body>
</html>