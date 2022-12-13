<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_CLASS = 'classes';
$DATABASE_LOGIN = 'phplogin';

/* connect to databases */
$sql_class = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_CLASS);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$sql_login = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_LOGIN);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['name'], $_POST['surname'], $_POST['username'], $_POST['pass1'],
		$_POST['pass2'], $_POST['address'], $_POST['phone_number'], $_POST['email'])) {
	exit('Please fill all fields!');
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

/* check if passwords match */
if ($_POST['pass1'] != $_POST['pass2']) {
	exit('Passwords do not match!');
}

/* check if username exists in the database */
$username = $_POST['username'];
$query = sprintf("SELECT COUNT(*) as count FROM accounts 
	WHERE username='%s'",
	mysqli_real_escape_string($sql_login, $username));
$result = mysqli_query($sql_login, $query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = $row['count'];
if ($count > 0) {
	exit("Username: $username already exists!");
}

/* create student record in classes database */
if ($stmt_classes = $sql_class->prepare("INSERT INTO student (name, surname) VALUES (?, ?)")) {
	$stmt_classes->bind_param("ss", $_POST['name'], $_POST['surname']);
	$stmt_classes->execute();
} else {
	echo 'Error inserting into student table!';
}

/* update register number based on student_id */
$register_number =  $sql_class->insert_id;
$stmt_classes->close();
$query_update_registerno = sprintf("UPDATE student SET register_number=%s WHERE id='%s'",
	mysqli_real_escape_string($sql_class, $register_number),
	mysqli_real_escape_string($sql_class, $register_number));

if ($sql_class->query($query_update_registerno) === TRUE) {
	echo "Record updated successfully";
} else {
	echo "Error updating record: " . $sql_class->error;
}

/* add new address for the student based on his student_it */


/* add new student to phplogin database and set register_number */


$sql_class->close();
$sql_login->close();
?>