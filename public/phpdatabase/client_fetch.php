<!-- fetch data for client search section -->
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
	SELECT * FROM class 
	WHERE name LIKE '%".$search."%'
	OR departament LIKE '%".$search."%'
	OR course LIKE '%".$search."%'
	OR semester LIKE '%".$search."%'
	";
} else {
	$query = "SELECT * FROM class ORDER BY class_id";
}

$return = '';
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
	$return .= '
	<div class="table-responsive">
		<table class="table table bordered">
		<tr>
			<th>Nazwa Przedmiotu</th>
			<th>Wydział</th>
			<th>Kierunek</th>
			<th>Semestr</th>
			<th></th>
		</tr>
	';

	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$className_tr = 'class_name'.$i;
		$departament_tr = 'departament'.$i;
		$course_tr = 'course'.$i;
		$semester_tr = 'semester'.$i;

		$form_tr = 'form'.$i;
		$submit_tr = 'submit'.$i;
		
		$return .= '
		<tr>
			<td><div><input type="text" name="'.$className_tr.'" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["name"].'"></div></td>
			<td><div><input type="text" name="'.$departament_tr.'" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["departament"].'"></div></td>
			<td><div><input type="text" name="'.$course_tr.'" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["course"].'"></div></td>
			<td><div><input type="text" name="'.$semester_tr.'" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["semester"].'"></div></td>
			<td>
				<div>
					<form id="'.$form_tr.'" method="post" action="database/enroll_to_class.php">
						<input type="submit" name="'.$submit_tr.'" value="Zapisz" onMouseOver="this.style.backgroundColor=\'#2691d9\'" onMouseOut="this.style.backgroundColor=\'#f1c50e\'">
					</form>
				</div>
			</td>
		</tr>
		';

		$i++;
	}

	$return .= '</table></div>';
	echo $return;
} else {
	echo 'Nic nie znaleziono';
}

?>