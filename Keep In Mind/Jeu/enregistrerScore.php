<?php  
	session_start();

	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$username = $_SESSION["username"];
	$mail = $_SESSION["mail"];
	$photo = $_SESSION["photo"];
	$score = $_SESSION["score"];

	$scoreFait = $_POST['ma_variable'];
	$newScore; 
	if ($scoreFait > 8){
		$newScore = $score + 5;
	}
	else if ($scoreFait > 6){
		$newScore = $score + 3;
	}
	else if ($scoreFait > 4){
		$newScore = $score + 1;
	}
	else if ($scoreFait > 2){
		$newScore = $score - 1;
	}
	else if ($scoreFait > 0){
		$newScore = $score - 2;
	}
	else {
		$newScore = $score - 3;
	}

	try {
		$connection = new PDO("mysql:host=localhost; dbname=projet", "root"
		);	
		$connection->exec("SET NAMES 'utf8'");
		$query = "UPDATE teachers SET score =:score WHERE login =:username";
		$statement = $connection->prepare($query);
		$statement->bindValue(":username", $username, PDO::PARAM_STR);
		$statement->bindValue(":score", $newScore, PDO::PARAM_STR);
		$statement->execute();
		$connection = null;

		$_SESSION["score"] = $newScore;

	} 
	catch (PDOException $e) {
		
	}
?>	