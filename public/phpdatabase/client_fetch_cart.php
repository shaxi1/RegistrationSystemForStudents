<!-- fetch data for client cart section -->
<?php

require 'get_student_details.php';
require 'get_class_details.php';

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

$studentClass = new Database_Student_Details($_SESSION['name']);
$student_id = $studentClass->returnStudentID();

if(isset($_POST["query"])) {
	$search = mysqli_real_escape_string($connect, $_POST["query"]);

	$query = "
		SELECT * FROM class 
		WHERE name LIKE '%".$search."%'
		OR departament LIKE '%".$search."%'
		OR course LIKE '%".$search."%'
		OR semester LIKE '%".$search."%' 
		AND class_id LIKE (
			SELECT class_id FROM class_registration 
			WHERE student_id = '".$student_id."'
		)
	";
} else {
	$query = "
		SELECT * FROM class 
		WHERE class_id LIKE (
			SELECT class_id FROM class_registration 
			WHERE student_id = '".$student_id."'
		)
	";
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
				<th>Prowadzący</th>
				<th>Pierwsze Zajęcia i Sala</th>
				<th></th>
			</tr>
	';

	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$form_tr = 'form'.$i;
		$submit_tr = 'submit'.$i;

		$classClass = new Database_Class_Details($row['class_id']);
		$lecturer_fullname = $classClass->getClassLecturerFullName();
		$room_date = $classClass->getClassroomAndDate();

		$return .= '
			<tr>
				<td><div><input type="text" name="class-name" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["name"].'"></div></td>
				<td><div><input type="text" name="departament_tr" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["departament"].'"></div></td>
				<td><div><input type="text" name="course" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["course"].'"></div></td>
				<td><div><input type="text" name="semester" form="'.$form_tr.'" readonly="readonly" style="background: transparent; border: none; outline: none;" value="'.$row["semester"].'"></div></td>
				<td>'.$lecturer_fullname.'</td>
				<td>'.$room_date.'</td>
				<input type="hidden" name="class_id" form="'.$form_tr.'" value="'.$row["class_id"].'">
				<input type="hidden" name="username" form="'.$form_tr.'" value="'.$_SESSION['name'].'">
		';

		/* add "Wypisz" (drop class) button */
		$return .= '<td>
						<div>
							<form id="'.$form_tr.'" action="phpdatabase/enroll_to_class.php" method="post">
								<input type="submit" name="'.$submit_tr.'" form="'.$form_tr.'" value="Wypisz" style="background-color:#cc3c43;" onMouseOver="this.style.backgroundColor=\'#2691d9\'" onMouseOut="this.style.backgroundColor=\'#cc3c43\'">
							</form>
						</div>
					</td>
				</tr>
		';
		
		unset($classClass);
		$i++;
	}

	$return .= '</table></div>';
	echo $return;
} else {
	echo 'Brak przedmiotów w koszyku.';
}

?>