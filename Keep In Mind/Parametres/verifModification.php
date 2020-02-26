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


	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$confirmPassword = $_POST["confirmPassword"];
	$mail = $_POST["mail"];

	if (strlen($username) < 4){
			echo "<p>"."Le nom d'utilisateur doit avoir au moins 4 caractères."."</p>";
	}
	else{
		if (checkUserName($username, $username1)){
			echo "<p>"."Ce nom d'utilisateur est déjà pris."."</p>";
		}
	}
	if (strlen($password) < 6){
		echo "<p>"."Le mot de passe doit contenir au moins 8 caractères."."</p>";
	}
	if (strcmp($password, $confirmPassword) != 0){
		echo "<p>"."Le mot de passe et sa confirmation doivent être identiques."."</p>";
	}
	if (!contains('@', $mail) || !contains('.', $mail)){
		echo "<p>"."L'adresse mail doit contenir un @ et un point."."</p>";
	}
	if (!((strlen($username) < 4) || (checkUserName($username, $username1)) || (strlen($password) < 6) || (strcmp($password, $confirmPassword) != 0) || (!contains('@', $mail) || !contains('.', $mail)))){

		echo "<p>"."Les champs ont été validés par le serveur."."</p>";
		$salt = generateRandomString(10);
		
		$password = hachPassword($password.$salt);
		$id = recupIdUser($username1);
		
		updateUser($id, $username, $firstname, $lastname, $mail, $password, $salt);
		echo "<p>"."Données modifiées"."</p>";

		$_SESSION["firstname"] = $firstname;
		$_SESSION["lastname"] = $lastname;
		$_SESSION["username"] = $username;
		$_SESSION["mail"] = $mail;


		header("Location: ../Compte/compte.php");
		exit();
	}
	else{
		header("Location: parametres.php");
		exit();
	}

	function recupIdUser($username2){
		try{
			$connection = new PDO(
				"mysql:host=localhost; dbname=projet",
				"root"
			);
			$connection->exec("SET NAMES 'utf8'");
			$query = "SELECT id FROM teachers WHERE login=:username";
			$statement = $connection->prepare($query);
			$statement->bindValue(":username", $username2, PDO::PARAM_STR);
			$statement->execute();
			$row = $statement->fetch();
			return $row[0];
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	function hachPassword($password){
		return (hash('sha384', $password));
	}

	function checkUserName($username, $trueUsername){
		try{
			$connection = new PDO(
				"mysql:host=localhost; dbname=projet",
				"root"
			);
			$connection->exec("SET NAMES 'utf8'");
			$query = "SELECT COUNT(*) FROM teachers WHERE login =:username";
			$statement = $connection->prepare($query);
    		$statement->bindValue(":username", $username, PDO::PARAM_STR);
    		$OK = $statement->execute();
			$connection = null;
			if ($OK === 1 && strcmp($username, $trueUsername) !== 0){
				return true;
			}
			return false;
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	function updateUser($id, $username, $firstname, $lastname, $mail, $password, $salt){
		try{
			$connection = new PDO(
				"mysql:host=localhost; dbname=projet",
				"root"
			);
			$connection->exec("SET NAMES 'utf8'");
			$query = "UPDATE teachers SET login =:login, firstname =:firstname, lastname =:lastname, email =:mail, password =:password, salt =:salt WHERE id =:id";
			$statement = $connection->prepare($query);
    		$statement->bindValue(":login", $username, PDO::PARAM_STR);
    		$statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    		$statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    		$statement->bindValue(":mail", $mail, PDO::PARAM_STR);
    		$statement->bindValue(":password", $password, PDO::PARAM_STR);
    		$statement->bindValue(":salt", $salt, PDO::PARAM_STR);
    		$statement->bindValue(":id", $id, PDO::PARAM_INT);
    		$statement->execute();
			$connection = null;
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	function contains($c, $s){
    	for ($i = 0; $i < strlen($s); $i++){
  	  		if ($s[$i] == $c){
        		return true;
	    	}
    	}
   		return false;
  	}

  	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
    	$randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>