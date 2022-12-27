<?php

function getMessage() {
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'phplogin';

	$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	/* fetch message */
	if ($stmt = $conn->prepare("SELECT message FROM message WHERE message_id=1")) {
		$stmt->execute();
		$stmt->bind_result($msg);
		$stmt->fetch();
	} else {
		echo 'Error fetching message!';
	}

	$stmt->close();
	$conn->close();

	return $msg;
}
?>