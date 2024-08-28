<?php
session_start();
include('config.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hub = $_POST['hub'];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO login (name, address, contact, email, password, hub, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $address, $contact, $email, $password, $hub, $role);

    if ($stmt->execute()) {
        echo "User created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRC Tracking App</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
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
  </style>
</head>
<body>
    <div class="wrapper sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px" style="justify-content: center;">
    <h3 class="text-center">Welcome to Admin</h3>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a class="active" href="user_management.php"><i class="fas fa-users"></i> User Management</a>
    <a href="user_list.php"><i class="fas fa-list"></i> User List</a>
    <a href="manifest.php"><i class="fas fa-file-upload"></i> Manifest</a>
    <a href="hub_management.php"><i class="fas fa-list"></i> HUB Management</a>
    <a href="admin_remit.php"><i class="fas fa-user-cog"></i> Remittance</a>
    <a href="reportpage.php"><i class="far fa-file-alt"></i> Report</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
<div class="content">
<div class="container">
    <section id="contact" class="py-1">
        <div class="position-relative py-4">
            <div class="position-relative">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="bg-transparent p-5 rounded shadow mt-5">
                                <h2 class="display-6 fw-bold text-center mb-4">Create a User</h2>
                                <form method="POST" action="user_management.php">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            <span id="emailValidationMessage"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="hub">HUB Management</label>
                                            <select id="hub" name="hub" class="form-control" required>
                                                <option selected disabled>Choose...</option>
                                                <option>Batangas</option>
                                                <option>Calamba</option>
                                                <option>Makati</option>
                                                <option>Pasay</option>
                                                <option>Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="role">Role</label>
                                            <select id="role" name="role" class="form-control" required>
                                                <option selected disabled>Choose...</option>
                                                <option>Admin</option>
                                                <option>Rider</option>
                                                <option>Staff</option>
                                            </select>
                                        </div>
                                    </div><br>
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</body>
<script>
    const emailInput = document.getElementById('email');
    const emailValidationMessage = document.getElementById('emailValidationMessage');
    const submitButton = document.getElementById('submit');

    const API_KEY = '81a7ab81a7780d58d0265de76abb33dc9bab3dee'; // Replace with your Hunter API key

    function validateEmailWithHunter(email) {
        fetch(`https://api.hunter.io/v2/email-verifier?email=${email}&api_key=${API_KEY}`)
            .then(response => response.json())
            .then(data => {
                if (data.data.result === 'deliverable') {
                    emailValidationMessage.textContent = '';
                    submitButton.disabled = false;
                } else {
                    emailValidationMessage.textContent = 'Invalid email address.';
                    submitButton.disabled = true;
                }
            })
            .catch(error => {
                emailValidationMessage.textContent = 'Error validating email.';
                submitButton.disabled = true;
            });
    }

    // Add event listener to the email input field
    emailInput.addEventListener('input', function () {
        validateEmailWithHunter(emailInput.value);
    });
</script>
</html>
