<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'class';
$ADMIN = 'admin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['name'], $_POST['departament'], $_POST['course'], $_POST['semester'],
		$_POST['room'], $_POST['date'], $_POST['lecturer_surname'], $_POST['lecturer_name'])) {
	exit('Please fill all fields!');
}



// mysql_insert_id(resource $link_identifier = NULL): int
// Retrieves the ID generated for an AUTO_INCREMENT column by the previous query (usually INSERT).


?>