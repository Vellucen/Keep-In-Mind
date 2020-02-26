<?php
	session_start();

	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$username = $_SESSION["username"];
	$mail = $_SESSION["mail"];
	$photo = $_SESSION["photo"];
	$score = $_SESSION["score"];

	if ($firstname){
	}
	else{
		header("Location: ../index.php");
		exit();
	}

	try{
		$connection = new PDO(
			"mysql:host=localhost; dbname=projet",
			"root"
		);
		$connection->exec("SET NAMES 'utf8'");
		$query = "SELECT id FROM teachers WHERE login=:username";
		$statement = $connection->prepare($query);
		$statement->bindValue(":username", $username, PDO::PARAM_STR);
		$statement->execute();
		$row = $statement->fetch();
		$id = $row[0];


		$query = "DELETE FROM teachersclasses WHERE teacher_id =:id";
		$statement = $connection->prepare($query);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();

		$query = "DELETE FROM teachers WHERE id =:id";
		$statement = $connection->prepare($query);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();

		$connection = null;
		echo "<p>"."Utilisateur supprimé"."</p>";
	}
	catch (PDOException $e){
		echo $e->getMessage();
	}
	header("Location: ../php/deconnexion.php");
	exit();
?>