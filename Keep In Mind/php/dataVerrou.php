<?php 
	session_start();
	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$username = $_SESSION["username"];
	$mail = $_SESSION["mail"];
	$photo = $_SESSION["photo"];
	$score = $_SESSION["score"];
	try {
		$tabDonnee = array();
		$connection = new PDO("mysql:host=localhost;dbname=projet","root");
		$connection->exec("SET NAMES 'utf8'");
		$query = "SELECT COUNT(*) AS count FROM students JOIN teachers ON teachers.login ='$username' JOIN teachersclasses ON teachersclasses.teacher_id = teachers.id JOIN studentsclasses ON studentsclasses.class_id = teachersclasses.class_id AND studentsclasses.student_id = students.id";
		$statement = $connection->query($query);
		$row = $statement->fetch();
		echo json_encode($row, JSON_UNESCAPED_SLASHES);
		$connection = null;
	}
	catch (PDOException $e){
		echo $e -> getMessage();
	}
?>