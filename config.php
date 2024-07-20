<?php
$servername = "localhost";
$email = "root";
$password = "";
$dbname = "tmstrackingdelivery";

// Create connection
$conn = new mysqli($servername, $email, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
