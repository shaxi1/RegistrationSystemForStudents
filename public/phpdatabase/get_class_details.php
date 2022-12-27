<?php

class Database_Class_Details {
	private static $sql_classes;

	private static $class_id;

	private static $DATABASE_HOST = 'localhost';
	private static $DATABASE_USER = 'root';
	private static $DATABASE_PASS = '';
	private static $ADMIN = 'admin';
	private static $DATABASE_NAME = 'classes';

	function __construct($class_id) {
		$this->connectToDatabase();

		self::$class_id = $class_id;
	}

	function __destruct() {
		$this->disconnectFromDatabase();
	}

	private function connectToDatabase() {
		self::$sql_classes = mysqli_connect(self::$DATABASE_HOST, self::$DATABASE_USER, self::$DATABASE_PASS, self::$DATABASE_NAME);
		if (mysqli_connect_errno()) {
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}
	}

	private function disconnectFromDatabase() {
		self::$sql_classes->close();
	}

	public function returnClassID() {
		return self::$class_id;
	}

	public function getClassLecturerFullName() {
		$lecturer_id = $this->getLecturerId();

		$stmt = self::$sql_classes->prepare('SELECT degree, name, surname FROM lecturer WHERE lecturer_id = ?');
		$stmt->bind_param('i', $lecturer_id);
		$stmt->execute();

		$stmt->bind_result($degree, $name, $surname);
		$stmt->fetch();

		$lecturer_full_name = $degree . ' ' . $name . ' ' . $surname;
		
		$stmt->close();
		return $lecturer_full_name;
	}

	private function getLecturerId() {
		$stmt = self::$sql_classes->prepare('SELECT lecturer_id FROM lecturer_classes WHERE class_id = ?');
		$stmt->bind_param('i', self::$class_id);
		$stmt->execute();

		$stmt->bind_result($lecturer_id);
		$stmt->fetch();
		
		$stmt->close();
		return $lecturer_id;
	}

	public function getClassroomAndDate() {
		$location_date_id = $this->getLocationDateId();

		$stmt = self::$sql_classes->prepare('SELECT room, event_date FROM location_date WHERE location_date_id = ?');
		$stmt->bind_param('i', $location_date_id);
		$stmt->execute();

		$stmt->bind_result($room, $event_date);
		$stmt->fetch();

		$classroom_and_date = $event_date . ' sala ' . $room;

		$stmt->close();
		return $classroom_and_date;
	}

	private function getLocationDateId() {
		$stmt = self::$sql_classes->prepare('SELECT location_date_id FROM class WHERE class_id = ?');
		$stmt->bind_param('i', self::$class_id);
		$stmt->execute();

		$stmt->bind_result($location_date_id);
		$stmt->fetch();

		$stmt->close();
		return $location_date_id;
	}

}

?>