<?php
require 'get_student_details.php';

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'classes';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

$studentClass = new Database_Student_Details($_POST['username']);
$studentID = $studentClass->returnStudentID();

if (!$studentClass->checkIfEnrolled($studentID, $_POST['class_id'])) {
	$studentClass->enrollToClass($studentID, $_POST['class_id']);
} else {
	$studentClass->dropClass($studentID, $_POST['class_id']);
}

$redirect = "http://localhost/client_dashboard.php";
header("Location: $redirect");
?>