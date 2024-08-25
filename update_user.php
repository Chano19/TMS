<?php
session_start();
include('config.php');


if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM login WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hub = $_POST['hub'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE login SET name = ?, address = ?, contact = ?, email = ?, password = ?, hub = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $name, $address, $contact, $email, $password, $hub, $role, $userId);

    if ($stmt->execute()) {
        echo "User updated successfully!";
        header('Location: user_management.php'); 
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-transparent p-5 rounded shadow mt-5">
                    <h2 class="display-6 fw-bold text-center mb-4">Update User</h2>
                    <form method="POST" action="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $user['contact']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="hub">HUB Management</label>
                                <select id="hub" name="hub" class="form-control" required>
                                    <option value="Batangas" <?php echo ($user['hub'] == 'Batangas') ? 'selected' : ''; ?>>Batangas</option>
                                    <option value="Calamba" <?php echo ($user['hub'] == 'Calamba') ? 'selected' : ''; ?>>Calamba</option>
                                    <option value="Makati" <?php echo ($user['hub'] == 'Makati') ? 'selected' : ''; ?>>Makati</option>
                                    <option value="Pasay" <?php echo ($user['hub'] == 'Pasay') ? 'selected' : ''; ?>>Pasay</option>
                                    <option value="Admin" <?php echo ($user['hub'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="form-control" required>
                                    <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="Rider" <?php echo ($user['role'] == 'Rider') ? 'selected' : ''; ?>>Rider</option>
                                    <option value="Staff" <?php echo ($user['role'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                                </select>
                            </div>
                        </div><br>
                        <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>
                        <a href="user_management.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>