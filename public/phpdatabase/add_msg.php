<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['msg'])) {
	exit('Please fill all fields!');
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

/* update message value */
if ($stmt = $conn->prepare("UPDATE message SET message=? WHERE message_id=1")) {
	$stmt->bind_param("s", $_POST['msg']);
	$stmt->execute();
} else {
	echo 'Error updating message!';
}

$stmt->close();
$conn->close();

$redirect_on_add_success = "http://localhost/admin_dashboard.php";
header("Location: $redirect_on_add_success");
?>