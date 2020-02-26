<?php 
	session_start();

	$username = $_POST["usernameConnex"];
	$password = $_POST["passwordConnex"];
  
	try{
		$connection = new PDO("mysql:host=localhost;dbname=projet","root");
		$connection->exec("SET NAMES 'utf8'");
		$query = "SELECT * FROM teachers WHERE login=:username";
		$statement = $connection->prepare($query);
		$statement->bindValue(":username", $username, PDO::PARAM_STR);
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		$connection = null;
	}
	catch (PDOException $e){
		echo $e -> getMessage();
	}
	$rowusername = $row["login"];
	$rowfirstname = $row["firstname"];
	$rowlastname = $row["lastname"];
	$rowmail = $row["email"];
	$rowpassword = $row["password"];
	$rowsalt = $row["salt"];
	$rowphoto = $row["photo"];
	$rowscore = $row["score"];

	$verifpassword = hash('sha384', $password.$rowsalt);
	if ($verifpassword == $rowpassword) {

		$_SESSION["firstname"] = $rowfirstname;
		$_SESSION["lastname"] = $rowlastname;
		$_SESSION["username"] = $rowusername;
		$_SESSION["mail"] = $rowmail;
		$_SESSION["photo"] = $rowphoto;
		$_SESSION["score"] = $rowscore;

		echo "connecté";

		header("Location: ../Compte/compte.php");
		exit();
	}
	else{
		header("Location: ../index.php" );
		exit();
	}
?>