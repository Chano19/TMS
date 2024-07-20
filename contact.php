<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $conn->real_escape_string($_POST['name']);
	$email = $conn->real_escape_string($_POST['email']);
	$message = $conn->real_escape_string($_POST['message']);
	
	$stmt = $conn->prepare("INSERT INTO tblcontact (name, email, message) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $name, $email, $message);
	
	if ($stmt->execute()) {
		echo'
			<script>
				alert("Your message has been sent successfully.");
			</script>
		';
		header('location:index.php#contact');
	} else {
		echo "Error: " . $stmt->error;
	}
}
?>