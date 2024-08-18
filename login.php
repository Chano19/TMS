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

        if ($user['role'] == 'Admin') {
            header('Location: admin.php');
            exit();
        } elseif ($user['role'] == 'Rider') {
            header('Location: rider_profile.php');
            exit();
        } elseif ($user['hub'] == 'Batangas') {
            header('Location: batangashub.php');
            exit();
        } elseif ($user['hub'] == 'Calamba') {
            header('Location: calambahub.php');
            exit();
        } elseif ($user['hub'] == 'Makati') {
            header('Location: makatihub.php');
            exit();
        } elseif ($user['hub'] == 'Pasay') {
            header('Location: pasayhub.php');
            exit();
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>