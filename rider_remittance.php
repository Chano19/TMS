<?php
$servername = "localhost";
$email = "u320585682_TMS";
$password = "Crctracking3";
$dbname = "u320585682_TMS";

// Create connection
$conn = new mysqli($servername, $email, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hub = $_POST['hub'];
    $rider_name = $_POST['rider_name'];
    $amount = $_POST['amount'];
    $datetime = $_POST['datetime'];

    // Format the datetime to be compatible with SQL TIMESTAMP
    $datetime = date('Y-m-d H:i:s', strtotime($datetime));

    $sql = "INSERT INTO remittance (hub, rider_name, amount, datetime) 
            VALUES ('$hub', '$rider_name', '$amount', '$datetime')";

    if ($conn->query($sql) === TRUE) {
        $alert = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch remittance data
$sql = "SELECT hub, rider_name, amount, datetime FROM remittance";
$result = $conn->query($sql);

// Calculate total amount
$total_sql = "SELECT SUM(amount) AS total_amount FROM remittance";
$total_result = $conn->query($total_sql);
$total_amount = $total_result->fetch_assoc()['total_amount'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRC Tracking App</title>
  <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
  <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: white;
      background-image: url("images/crcbg.jpg");
      background-repeat: no-repeat;
      background-size: 1800px 900px;
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
    .content {
      margin-left: 200px;
      padding: 16px;
    }
    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      .content {margin-left: 0;}
    }
    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
    .card {
      margin: 20px 0;
      padding: 30px;
      border: 1px solid #ddd3;
      border-radius: 5px;
      background-color: rgba(255, 255, 255, 0.9);
      font-family: "Times New Roman", Times, serif;
      margin-top: 30px;
    }
    .ords {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label, input, textarea {
     display: block; 
     width: 100%;
     margin: 8px 0;
     margin-left: 300px;
      }
    h4{
        margin-left: 420px;
    }
    .table{
        background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img class="rounded-pill mt-3 mx-auto d-block" src="images/crc.jpg" alt="" height="150px">
    <h3 class="text-center">Welcome to Rider Hub</h3>
    <a href="rider_profile.php">Profile</a>
    <a href="rider_batangas.php">Order</a>
    <a class="active" href="rider_remittance.php">Remittance</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="content">
    <div class="container">
      <table class="table table-hover mt-3 border border-1">
        <thead class="bg-info">
          <tr>
            <th>Hub</th>
            <th>Rider Name</th>
            <th>Amount</th>
            <th>Date/Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["hub"]. "</td>
                            <td>" . $row["rider_name"]. "</td>
                            <td>" . $row["amount"]. "</td>
                            <td>" . $row["datetime"]. "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
          ?>
        </tbody>
      </table>
      <div>
            <h4>Total: <?php echo $total_amount; ?></h4>
        </div>
      <div class="card">
        <div class="row">
          <div class="col-md-5">
            <h2>Remittance Form</h2>
            <form method="POST" action="remittance.php">

                <label for="hub">Hub:</label>
                <input type="text" id="hub" name="hub" value="Batangas" required>

                <label for="rider_name">Rider Name:</label>
                <input type="text" id="rider_name" name="rider_name" required>

                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" required>
                
                <label for="datetime">Date/Time:</label>
                <input type="datetime-local" id="datetime" name="datetime" required>

                <input type="submit" value="Submit">
            </form>
        </div>
      </div>
     </div>
  </div>
  <?php if ($alert): ?>
    <script>
      alert("New remittance entry added successfully!");
    </script>
  <?php endif; ?>
</body>
</html>
