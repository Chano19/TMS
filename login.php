<?php
session_start();
include('config.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // Using MD5 for hashing

    $query = "SELECT * FROM login WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $user['email'];
        $_SESSION['hub'] = $user['hub'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: admin.php');
            exit();
        } elseif ($user['hub'] == 'Batangas') {
            header('Location: batangashub.php');
            exit();
        } else {
            header('Location: calambahub.php');
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>