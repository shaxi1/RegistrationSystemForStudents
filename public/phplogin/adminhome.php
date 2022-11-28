<?php
$LINK_ADMIN = "http://localhost/admin_dashboard.php";
session_start();

if (isset($_SESSION['loggedin'])) {
	header("Location: $LINK_ADMIN");
	exit;
}
?>