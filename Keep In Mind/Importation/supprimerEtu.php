<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../image/icone.png" />
	<meta charset="utf-8"></meta>
	<meta name="description" content="Upload de photos"></meta>
	<meta name="keywords" content="Keep In Mind, upload, photo"></meta>
	<title>UploadImage</title>
	<link rel="stylesheet" href="../css/css.css"/>
</head>
<body>
	<div id="retour"><a href="importation.php">Retour</a></div>
	<div id="uploadDiv">
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

	$connection = new PDO("mysql:host=localhost;dbname=projet","root");
				$connection->exec("SET NAMES 'utf8'");
	if (verifExistence($connection, $_POST["prenom"], $_POST["nom"])){
		$id = recupIdEtu($connection, $_POST["prenom"], $_POST["nom"]);
		suppFichier($connection, $id);
		$query1 = "DELETE FROM studentsclasses WHERE student_id = $id";
		$connection->query($query1);
		$query2 = "DELETE FROM students WHERE id = $id";
		$connection->query($query2);
		echo "Etudiant supprimé";
	}
	else {
		echo "Cet étudiant n'est pas dans la base de données. Suppression impossible";
	}

	function verifExistence ($connection, $prenom, $nom){
		$query = "SELECT COUNT(*) FROM students WHERE firstname =:firstname AND lastname=:lastname";
		$statement = $connection->prepare($query);
		$statement->bindValue(":firstname", $prenom, PDO::PARAM_STR);
		$statement->bindValue(":lastname", $nom, PDO::PARAM_STR);
		$statement->execute();
		$tab = $statement->fetch();
		if ($tab[0] == 0){
			return false;
		}
		return true;
	}	

	function recupIdEtu ($connection, $prenom, $nom){
		$query="SELECT id FROM students WHERE firstname =:prenom AND lastname =:nom";
		$statement = $connection->prepare($query);
		$statement->bindValue(":prenom", $prenom, PDO::PARAM_STR);
		$statement->bindValue(":nom", $nom, PDO::PARAM_STR);
		$statement->execute();
		$tab = $statement->fetch();
		return $tab[0];
	}

	function suppFichier ($connection, $id){
		$query="SELECT photo FROM students WHERE id = $id";
		$result = $connection->query($query);
		$tab = $result->fetch();
		unlink("../photoEtu/".$tab[0]);
	}
?>
</div>
</body>
</html>