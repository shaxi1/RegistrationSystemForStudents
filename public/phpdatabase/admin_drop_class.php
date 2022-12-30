<?php
require 'get_class_details.php';

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'classes';
$DATABASE_LOGIN = 'phplogin';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$conn_phplogin = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_LOGIN);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$_POST = array_map("trim", $_POST);
$_POST = array_map("htmlspecialchars", $_POST);

if(isset($_POST["query"])) {
	$search = mysqli_real_escape_string($conn, $_POST["query"]);

	$query = "
		SELECT * FROM class_registration 
		WHERE student_id = '".$search."' 
		OR class_id LIKE '%".$search."%'
	";
} else {
	$query = "
		SELECT * FROM class_registration 
	";
}

$return = '';
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
	$return .='
		<div class="table-responsive">
			<table class="table table bordered">
			<tr>
				<th>Student Username</th>
				<th>Class Name</th>
				<th>Student ID</th>
				<th>Class ID</th>
				<th></th>
			</tr>
	';

	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$form_tr = 'form'.$i;
		$submit_tr = 'submit'.$i;
	
		/* get student username */
		$student_id = $row['student_id'];
		$query_student_username = "
			SELECT username FROM accounts 
			WHERE register_number = '".$student_id."'
		";
		$result_student_username = mysqli_query($conn_phplogin, $query_student_username);
		$row_student_username = mysqli_fetch_array($result_student_username);
		$student_username = $row_student_username['username'];

		/* get class name */
		$classClass = new Database_Class_Details($row['class_id']);
		$class_name = $classClass->getClassName();

		$return .='
			<tr>
				<td><div><input type="text" name="student_username" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$student_username.'"></div></td>
				<td><div><input type="text" name="class_name" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$class_name.'"></div></td>
				<td><div><input type="text" name="student_id" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row['student_id'].'"></div></td>
				<td><div><input type="text" name="class_id" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row['class_id'].'"></div></td>
		';

		/* add (Wypisz) drop class button */
		$return .='
				<td>
					<form action="phpdatabase/drop_class.php" method="post" id="'.$form_tr.'">
						<input type="hidden" name="student_id" value="'.$row['student_id'].'">
						<input type="hidden" name="class_id" value="'.$row['class_id'].'">
						<input type="submit" name="submit" value="Wypisz" id="'.$submit_tr.'" style="background-color:#cc3c43;" onMouseOver="this.style.backgroundColor=\'#2691d9\'" onMouseOut="this.style.backgroundColor=\'#cc3c43\'">
					</form>
				</td>
			</tr>
		';


		unset($classClass);
		$i++;
	}
		
		$return .='</table></div>';
		echo $return;
} else {
	echo 'Nie znaleziono żadnych wyników.';
}

?>