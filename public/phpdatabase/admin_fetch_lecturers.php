<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'classes';

$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

if(isset($_POST["query"])) {
	$search = mysqli_real_escape_string($connect, $_POST["query"]);

	$query = "
	SELECT * FROM lecturer 
	WHERE degree LIKE '%".$search."%'
	OR surname LIKE '%".$search."%'
	OR name LIKE '%".$search."%'
	";
} else {
	$query = "SELECT * FROM lecturer ORDER BY lecturer_id";
}

$return = '';
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
	$return .= '
	<div class="table-responsive">
		<table class="table table bordered">
		<tr>
			<th>Imię</th>
			<th>Nazwisko</th>
			<th>Stopień</th>
		</tr>
	';

	while ($row = mysqli_fetch_array($result)) {
		$return .= '
		<tr>
			<td>'.$row["name"].'</td>
			<td>'.$row["surname"].'</td>
			<td>'.$row["degree"].'</td>
		</tr>
		';
	}

	$return .= '
		</table></div>
	';
	echo $return;
} else {
	echo 'Brak wykładowców';
}


?>