<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'class';
$ADMIN = 'admin';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['name'], $_POST['departament'], $_POST['course'], $_POST['semester'],
		$_POST['room'], $_POST['date'], $_POST['lecturer_surname'], $_POST['lecturer_name'])) {
	exit('Please fill all fields!');
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

/* use statements to prevent SQL injection
   statement for location_date table */
if ($stmt_location_date = $conn->prepare("INSERT INTO location_date (room, event_date) VALUES (?, ?)")) {
	$stmt_location_date->bind_param("is", $_POST['room'], $_POST['date']);
	$stmt_location_date->execute();
} else {
	echo 'Error inserting to location_date table!';
}

/* get autoincrement value of location_date_id */
$location_date_idx =  mysql_insert_id();
$stmt_location_date->close();

/* statement for location_date table */
if ($stmt_class = $conn->prepare("INSERT INTO class (location_date_id, name, departament, course, semester) VALUES (?, ?, ?, ?, ?)")) {
	$stmt_class->bind_param("isssi", $location_date_idx, $_POST['name'], $_POST['departamend'], $_POST['course'], $_POST['semester']);
	$stmt_class->execute();
} else {
	echo 'Error inserting to class table!';
}

/* get autoincrement value of class_id */
$class_idx =  mysql_insert_id();
$stmt_class->close();
/* get lecturer_id by Name and Surname */
$lecturer_name = $_POST['lecturer_name'];
$lecturer_surname = $_POST['lecturer_surname'];
$query = sprintf("SELECT lecturer_id FROM lecturer 
	WHERE name='%s' AND surname='%s'",
	mysql_real_escape_string($lecturer_name),
	mysql_real_escape_string($lecturer_surname));

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, 'MYSQLI_ASSOC');
$lecturer_idx = $row['lecturer_id'];
if ($lecturer_idx == false) {
	exit("No such lecturer: ($lecturer_name) ($lecturer_surname)");
}

/* statement for lecturer_classes (association of lecturer_id with class_id) */
if ($stmt_lecturer_classes = $conn->prepare("INSERT INTO lecturer_classes (lecturer_id, class_id) VALUES (?, ?)")) {
	$stmt_lecturer_classes->bind_param("ii", $class_idx, $lecturer_idx);
	$stmt_lecturer_classes->execute();
} else {
	echo 'Error inserting to lecturer_classes table!';
}

$stmt_lecturer_classes->close();
?>