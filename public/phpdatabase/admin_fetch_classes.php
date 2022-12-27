<?php
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
            <th>Nazwa</th>
            <th>Wydział</th>
            <th>Kierunek</th>
            <th>Semestr</th>
            <th>Prowadzący</th>
            <th>Pierwsze Zajęcia i Sala</th>
        </tr>
    ';

    while ($row = mysqli_fetch_array($result)) {
        $classDetails = new Database_Class_Details($row["class_id"]);
        $lecturer_fullname = $classDetails->getClassLecturerFullName();
        $room_date = $classDetails->getClassroomAndDate();

        $return .= '
        <tr>
            <td>'.$row["name"].'</td>
            <td>'.$row["departament"].'</td>
            <td>'.$row["course"].'</td>
            <td>'.$row["semester"].'</td>
            <td>'.$lecturer_fullname.'</td>
            <td>'.$room_date.'</td>
        </tr>
        ';

        unset($classDetails);
    }

    $return .= '
        </table></div>
    ';
    echo $return;
} else {
    echo 'Brak przedmiotów';
}

?>