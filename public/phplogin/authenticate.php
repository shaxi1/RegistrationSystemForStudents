<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$ADMIN = 'admin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['username'], $_POST['password'])) {
	exit('Please fill both the username and password fields!');
}

$_POST = array_map("trim", $_POST);
$parsed_username = htmlspecialchars($_POST['username']);
$parsed_pass = htmlspecialchars($_POST['password']);

/* use $stmt to prevent SQL injection */
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $parsed_username);
	$stmt->execute();
	$stmt->store_result();

	/* check if acc exists */
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		
		/* only passwords encrypted with bcrypt will work */
		if (password_verify($parsed_pass, $password)) {
			/* session_regenerate_id() also helps prevent session hijacking
			it regenerates the user's session ID that is stored on the server
			and as a cookie in the browser */
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $parsed_username;
			$_SESSION['id'] = $id;

			if ($parsed_username == $ADMIN) {
				header("Location: adminhome.php");
			} else {
				header("Location: userhome.php");
			}
		} else {
			echo 'Incorrect username and/or password';
		}
	} else {
		echo 'Incorrect username and/or password';
	}

	$stmt->close();
}
?>