<?php
session_start();
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
				</table>
			</div>
		</div>

	</body>

</html>