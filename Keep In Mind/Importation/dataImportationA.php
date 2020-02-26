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
		$query = "SELECT students.id, students.lastname, students.firstname, students.photo, students.sexe, classes.name FROM students JOIN teachers ON teachers.login ='$username' JOIN teachersclasses ON teachersclasses.teacher_id = teachers.id JOIN studentsclasses ON studentsclasses.class_id = teachersclasses.class_id AND studentsclasses.student_id = students.id JOIN classes ON classes.id = studentsclasses.class_id ORDER BY students.lastname";
		$results = $connection->query($query);
		$tabDonnee = $results->fetchAll();
		echo json_encode($tabDonnee, JSON_UNESCAPED_SLASHES);
		$connection = null;
	}
	catch (PDOException $e){
		echo $e -> getMessage();
	}
?>