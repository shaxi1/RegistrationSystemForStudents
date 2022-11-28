<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$ADMIN = 'admin';
$LINK_ADMIN = "http://localhost/admin_dashboard.html";
$LINK_USER = "http://localhost/client_dashboard.html";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/* ignores data not submitted via form */
if (!isset($_POST['username'], $_POST['password'])) {
	exit('Please fill both the username and password fields!');
}

/* use $stmt to prevent SQL injection */
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

	/* check if acc exists */
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		
		/* only passwords encrypted with bcrypt will work */
		if (password_verify($_POST['password'], $password)) {
			if ($_POST['username'] == $ADMIN) {
				/* session_regenerate_id() also helps prevent session hijacking
				it regenerates the user's session ID that is stored on the server
				and as a cookie in the browser */
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['username'];
				header("Location: $LINK_ADMIN");
			} else {
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['username'];
				$_SESSION['id'] = $id;
				header("Location: $LINK_USER");
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