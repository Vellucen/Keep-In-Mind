<?php 
	session_start();



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
		if (checkUserName($username)){
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
	if (!((strlen($username) < 4) || (checkUserName($username)) || (strlen($password) < 6) || (strcmp($password, $confirmPassword) != 0) || (!contains('@', $mail) || !contains('.', $mail)))){

		echo "<p>"."Les champs ont été validés par le serveur."."</p>";
		$salt = generateRandomString(10);
		
		$password = hachPassword($password.$salt);
		
		addUser($username, $firstname, $lastname, $mail, $password, $salt);
		echo "<p>"."Utilisateur enregistré"."</p>";

		$_SESSION["firstname"] = $firstname;
		$_SESSION["lastname"] = $lastname;
		$_SESSION["username"] = $username;
		$_SESSION["mail"] = $mail;
		$_SESSION["photo"] = "noProfil.png";
		$_SESSION["score"] = 0;


		header("Location: finalInscription.php");
		exit();
	}
	else{
		header("Location: ../index.php");
		exit();
	}



	function hachPassword($password){
		return (hash('sha384', $password));
	}

	function checkUserName($username){
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
			if ($OK === 0){
				return true;
			}
			return false;
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	function addUser($username, $firstname, $lastname, $mail, $password, $salt){
		try{
			$connection = new PDO(
				"mysql:host=localhost; dbname=projet",
				"root"
			);
			$connection->exec("SET NAMES 'utf8'");
			$query = "INSERT INTO teachers (login, firstname, lastname, email, password, salt) VALUES (:login, :firstname, :lastname, :mail, :password, :salt)";
			$statement = $connection->prepare($query);
    		$statement->bindValue(":login", $username, PDO::PARAM_STR);
    		$statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    		$statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    		$statement->bindValue(":mail", $mail, PDO::PARAM_STR);
    		$statement->bindValue(":password", $password, PDO::PARAM_STR);
    		$statement->bindValue(":salt", $salt, PDO::PARAM_STR);
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