<?php
require '../phpdatabase/get_student_details.php';
session_start();

// TODO: potennially add to other files
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
// TODO: end

$studentClass = new Database_Student_Details($_SESSION['name']);
/* get details */
$name = $studentClass->getStudentName();
$surname = $studentClass->getStudentSurname();
$address = $studentClass->getStudentAddress();
$phone = $studentClass->getStudentPhone();
$email = $studentClass->getStudentEmail();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Strona Profilowa</title>
		<link href="http://localhost/css/profile.css" rel="stylesheet" type="text/css">
	</head>

	<body class="loggedin">

		<nav class="navtop">
			<div>
				<h1></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profil</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj</a>
			</div>
		</nav>
		<div class="content">
			<h2>Twój Profil</h2>
			<div>
				<p>Twoje dane:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Imię:</td>
						<td><?=$name?></td>
					</tr>
					<tr>
						<td>Nazwisko:</td>
						<td><?=$surname?></td>
					</tr>
					<tr>
						<td>Adres:</td>
						<td><?=$address?></td>
					</tr>
					<tr>
						<td>Telefon:</td>
						<td><?=$phone?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>

	</body>

</html>