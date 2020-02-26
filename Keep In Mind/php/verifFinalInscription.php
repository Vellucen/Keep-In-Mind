<?php
	session_start();

	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$username = $_SESSION["username"];
	$mail = $_SESSION["mail"];
	$photo = $_SESSION["photo"];
	$score = $_SESSION["score"];

	if (!isset($_POST['promotion'])){
		header("Location: finalInscription.php");
		exit();
	}
	else{
		$promotion = $_POST['promotion'];
		try{
			$connection = new PDO("mysql:host=localhost; dbname=projet", "root");
			$connection->exec("SET NAMES 'utf8'");
			$id = idUser($connection, $username);
			for ($i = 0; $i < sizeof($promotion); $i++){
				$class = idClasse($connection, $promotion[$i]);
				addClass($connection, $class, $id);
			}
			header("Location: ../Compte/Compte.php");
			exit();
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	function idUser ($connection, $user){
		$query = "SELECT id FROM teachers WHERE login=:username";
		$statement = $connection->prepare($query);
		$statement->bindValue(":username", $user, PDO::PARAM_STR);
		$statement->execute();
		$row = $statement->fetch();
		return $row[0];
	}

	function idClasse ($connection, $nom){
		$query = "SELECT id FROM classes WHERE name=:nom";
		$statement = $connection->prepare($query);
		$statement->bindValue(":nom", $nom, PDO::PARAM_STR);
		$statement->execute();
		$row = $statement->fetch();
		return $row[0];
	}

	function addClass ($connection, $idClass, $idUser){
		$query = "INSERT INTO teachersclasses (teacher_id, class_id) VALUES (:id, :class)";
		$statement = $connection->prepare($query);
		$statement->bindValue(":id", $idUser, PDO::PARAM_STR);
		$statement->bindValue(":class", $idClass, PDO::PARAM_STR);
		$statement->execute();
	}
?>