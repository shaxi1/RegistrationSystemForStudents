<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'classes';
$ADMIN = 'admin';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['name'], $_POST['surname'], $_POST['degree'])) {
    exit('Please fill all fields!');
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

/* use statements to prevent SQL injection
   statement for lecturer table */
if ($stmt_lecturer = $conn->prepare("INSERT INTO lecturer (name, surname, degree) VALUES (?, ?, ?)")) {
    $stmt_lecturer->bind_param("sss", $_POST['name'], $_POST['surname'], $_POST['degree']);
    $stmt_lecturer->execute();
} else {
    exit('Error inserting to lecturer table!');
}

$stmt_lecturer->close();

$conn->close();
$redirect_on_add_success = "http://localhost/admin_dashboard.php";
header("Location: $redirect_on_add_success");
?>