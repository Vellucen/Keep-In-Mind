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
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../image/icone.png" />
	<meta charset="utf-8"></meta>
	<meta name="description" content="Upload de photos"></meta>
	<meta name="keywords" content="Balance Ton Etudiant, upload, photo"></meta>
	<title>Upload</title>
	<link rel="stylesheet" href="../css/css.css"/>
</head>
<body>
	<div id="retour"><a href="importation.php">Retour</a></div>
	<div id="uploadDiv">
	<?php
	$nouveauNomFichier;
	/*
	** IMPORTATION DE LA PHOTO
	*/
	if(isset($_POST['submit'])) {
		$fichier = $_FILES['file'];
		$nomFichier = $_FILES['file']['name'];
		$nomTmpName = $_FILES['file']['tmp_name'];
		$fichierErreur = $_FILES['file']['error'];
		$typeFichier = $_FILES['file']['type'];

		$extentionFichier = explode('.',$nomFichier);
		$extentionActuelleFichier = strtolower(end($extentionFichier)); //strtolower pour ne pas prendre compte des majucules, end pour prendre le dernier élément de l'array

		$extentionsAutorisees = array('jpg','jpeg','png'); 

		if(in_array($extentionActuelleFichier,$extentionsAutorisees)) { //Si l'extention est acceptée
			if($fichierErreur===0) { //S'il n'y a pas d'erreur
				//$nouveauNomFichier = uniqid('',true).".".$extentionActuelleFichier;
				//$nouveauNomFichier = $nomFichier.".".$extentionActuelleFichier;
				$nouveauNomFichier = $nomFichier;
				$destinationFichier = '../photoEtu/'.$nouveauNomFichier;

				move_uploaded_file($nomTmpName,$destinationFichier); //Si le fichier importé a bien été importé par HTTP POST, il est déplacé dans le dossier "photosEtu"
				//Dans le cas où plusieurs photos sont selectionnées, la première seulement est importée.
				/* AJOUT DE L'UTILISATEUR DANS LA BASE DE DONNEES*/
				$connection = new PDO("mysql:host=localhost;dbname=projet","root");
				$connection->exec("SET NAMES 'utf8'");
				$valide = true;
				if(isset($_POST['prenom'])) {
					$prenom = $_POST['prenom'];

					if(isset($_POST['nom'])) {
						$nom = $_POST['nom'];

						if(isset($_POST['promotion'])) {
							$promotion = $_POST['promotion'];

							if(isset($_POST['sexe'])) {
								$sexe = $_POST['sexe'];
							}
							else {
								$valide=false;
							}
						}
						else {
							$valide=false;
						}
					}
					else {
						$valide=false;
					}
				}
				else {
					$valide=false;
				}

				if($valide==true) {
					if (verifAppart($connection, $prenom, $nom)){
						$eleveOk = addUser($connection,$prenom,$nom,$promotion,$sexe, $nouveauNomFichier);
						if($eleveOk) {
							echo "L'importation a bien été réalisée";
							$idClasse = recupIdClass($connection, $promotion);
							$idProf = recupIdProf($connection, $username);
							updateClasseProf($connection, $idClasse, $idProf);
						}
						else {
							echo "L'importation n'a pas abouti";
						}
					}
					else {
						echo "L'élève appartient déjà à la base de donnée.";
					}
				}
				else {
					echo "Il manque des informations";
				}
			}
			else {
				echo "Il y a une erreur dans le fichier importé.";
			}
		}
		else {
			echo "Vous ne pouvez pas importer un fichier de ce type. Les extensions autorisées sont jpg, jpeg et png.";
		}

	//Pour que ça marche, j'ai du donner les droits de lecture et écriture à tout le monde (everyone) du dossier contenant les photos importées (photosEtu)
	}

	function recupIdProf($connection, $username2){
		$query="SELECT id FROM teachers WHERE login =:username";
		$statement = $connection->prepare($query);
		$statement->bindValue(":username", $username2, PDO::PARAM_STR);
		$statement->execute();
		$tab = $statement->fetch();
		return $tab[0];
	}

	function recupIdClass($connection, $promotion){
		$query="SELECT id FROM classes WHERE name =:name";
		$statement = $connection->prepare($query);
		$statement->bindValue(":name", $promotion, PDO::PARAM_STR);
		$statement->execute();
		$tab = $statement->fetch();
		return $tab[0];
	}

	function verifAppart($connection, $prenom, $nom){
		$query = "SELECT COUNT(*) FROM students WHERE firstname =:firstname AND lastname=:lastname";
		$statement = $connection->prepare($query);
		$statement->bindValue(":firstname", $prenom, PDO::PARAM_STR);
		$statement->bindValue(":lastname", $nom, PDO::PARAM_STR);
		$statement->execute();
		$tab = $statement->fetch();
		if ($tab[0] == 0){
			return true;
		}
		return false;
	}

	//Ajout d'un éléve dans la base de données
	function addUser($connection, $prenom, $nom, $promotion, $sexe, $photo){
    	$query = "INSERT INTO students (lastname,firstname, photo, sexe) VALUES (:lastname, :firstname, :photo, :sexe)";
		$statement = $connection->prepare($query);
		$statement->bindValue(":lastname", $nom, PDO::PARAM_STR);
		$statement->bindValue(":firstname", $prenom, PDO::PARAM_STR);
		$statement->bindValue(":sexe", $sexe, PDO::PARAM_STR);
		$statement->bindValue(":photo", $photo, PDO::PARAM_STR);

		$OK1 = $statement->execute();

		$id_eleve = $connection->query("SELECT id FROM students WHERE lastname='$nom' AND firstname='$prenom'");
		$id_eleve = $id_eleve->fetch();
		$id_classe = $connection->query("SELECT id FROM classes WHERE name='$promotion'");
		$id_classe = $id_classe->fetch();
		$query = "INSERT INTO studentsclasses(student_id,class_id) VALUES ($id_eleve[0],$id_classe[0])";
		$statement = $connection->prepare($query);
		$OK2 = $statement->execute();

		return ($OK1&&$OK2);
  }

  	function updateClasseProf ($connection, $promotion, $username2){
	  	$query = "SELECT COUNT(*) FROM teachersclasses WHERE teacher_id=:username AND class_id =:promotion";
		$statement = $connection->prepare($query);
		$statement->bindValue(":username", $username2, PDO::PARAM_INT);
		$statement->bindValue(":promotion", $promotion, PDO::PARAM_INT);
		$statement->execute();
		$tab = $statement->fetch();
		if ($tab[0] == 0){
			$query2 = "INSERT INTO teachersclasses (teacher_id, class_id) VALUES ($username2, $promotion)";
			$results = $connection->query($query2);
		}
	}
?>
</div>
</body>
</html>