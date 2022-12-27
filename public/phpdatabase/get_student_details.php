<?php

class Database_Student_Details {
	private static $sql_classes;
	private static $sql_login;

	private static $student_id;

	private static $DATABASE_HOST = 'localhost';
	private static $DATABASE_USER = 'root';
	private static $DATABASE_PASS = '';
	private static $ADMIN = 'admin';
	private static $DATABASE_NAME = 'classes';
	private static $DATABASE_LOGIN = 'phplogin';

	function __construct($username) {
		$this->connectToDatabase();

		$student_id = $this->getStudentId($username);
	}

	function __destruct() {
		$this->disconnectFromDatabase();
	}

	private function getStudentId($username) {
		self::$sql_login = mysqli_connect(self::$DATABASE_HOST, self::$DATABASE_USER, self::$DATABASE_PASS, self::$DATABASE_LOGIN);
		if (mysqli_connect_errno()) {
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}

		$sql_query = "SELECT register_number FROM accounts WHERE username = '$username'";
		$result = mysqli_query(self::$sql_login, $sql_query);
		$row = mysqli_fetch_assoc($result);
		self::$student_id = $row['register_number'];

		self::$sql_login->close();
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

	public function returnStudentID() {
		return self::$student_id;
	}

	public function getStudentName() {
		$stmt = self::$sql_classes->prepare('SELECT name FROM student WHERE student_id = ?');
		$stmt->bind_param('i', self::$student_id);
		$stmt->execute();
		$stmt->bind_result($name);
		$stmt->fetch();

		$stmt->close();
		return $name;
	}

	public function getStudentSurname() {
		$stmt = self::$sql_classes->prepare('SELECT surname FROM student WHERE student_id = ?');
		$stmt->bind_param('i', self::$student_id);
		$stmt->execute();
		$stmt->bind_result($surname);
		$stmt->fetch();

		$stmt->close();
		return $surname;
	}

	public function getStudentAddress() {
		$stmt = self::$sql_classes->prepare('SELECT full_address FROM address WHERE student_id = ?');
		$stmt->bind_param('i', self::$student_id);
		$stmt->execute();
		$stmt->bind_result($full_address);
		$stmt->fetch();

		$stmt->close();
		return $full_address;
	}

	public function getStudentEmail() {
		$stmt = self::$sql_classes->prepare('SELECT email FROM address WHERE student_id = ?');
		$stmt->bind_param('i', self::$student_id);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->fetch();

		$stmt->close();
		return $email;
	}

	public function getStudentPhone() {
		$stmt = self::$sql_classes->prepare('SELECT phone FROM address WHERE student_id = ?');
		$stmt->bind_param('i', self::$student_id);
		$stmt->execute();
		$stmt->bind_result($phone);
		$stmt->fetch();

		$stmt->close();
		return $phone;
	}

	public function getFullStudentDetailsString() {
		$studentName = $this->getStudentName();
		$studentSurname = $this->getStudentSurname();
		$studentAddress = $this->getStudentAddress();
		$studentEmail = $this->getStudentEmail();
		$studentPhone = $this->getStudentPhone();

		$studentDetails = $studentName . ' ' . $studentSurname . ' ' . $studentAddress . ' ' . $studentEmail . ' ' . $studentPhone;
		return $studentDetails;
	}

	public function checkIfEnrolled($class_id) {
		$query = sprintf("SELECT COUNT(*) as count FROM class_registration WHERE class_id = '%s' AND student_id = '%s'",
			mysqli_real_escape_string(self::$sql_classes, self::$student_id),
			mysqli_real_escape_string(self::$sql_classes, $class_id));
		
		$result = mysqli_query(self::$sql_classes, $query);
		$row = mysqli_fetch_assoc($result);
		$count = $row['count'];

		if ($count > 0)
			return true;
		return false;
	}

	public function enrollToClass($class_id) {
		$stmt = self::$sql_classes->prepare('INSERT INTO class_registration (class_id, student_id) VALUES (?, ?)');
		$stmt->bind_param('ii', $class_id, self::$student_id);
		$stmt->execute();

		$stmt->close();
	}

	public function dropClass($class_id) {
		$stmt = self::$sql_classes->prepare('DELETE FROM class_registration WHERE student_id = ? AND class_id = ?');
		$stmt->bind_param('ii', self::$student_id, $class_id);
		$stmt->execute();

		$stmt->close();
	}

}
?>