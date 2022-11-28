<?php
$LINK_USER = "http://localhost/client_dashboard.php";
session_start();

if (isset($_SESSION['loggedin'])) {
	header("Location: $LINK_USER");
	exit;
}
?>