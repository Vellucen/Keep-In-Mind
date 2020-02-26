<?php
	session_start();

	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$username1 = $_SESSION["username"];
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
	<title>UploadImage</title>
	<link rel="stylesheet" href="../css/css.css"/>
</head>
<body>
	<div id="retour"><a href="parametres.php">Retour</a></div>
	<div id="uploadDiv">
	<?php
	$nouveauNomFichier;
	/*
	** IMPORTATION DE LA PHOTO
	*/
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
				$destinationFichier = '../photoProf/'.$nouveauNomFichier;

				move_uploaded_file($nomTmpName,$destinationFichier); //Si le fichier importé a bien été importé par HTTP POST, il est déplacé dans le dossier "photosEtu"
				//Dans le cas où plusieurs photos sont selectionnées, la première seulement est importée.
				/* AJOUT DE L'UTILISATEUR DANS LA BASE DE DONNEES*/
				$connection = new PDO("mysql:host=localhost;dbname=projet","root");
				$connection->exec("SET NAMES 'utf8'");
				suppFichier();
				$Ok = addPhoto($connection,$nouveauNomFichier, $username1);
				if($Ok) {
					echo "L'importation a bien été réalisée";
					$_SESSION["photo"] = $nouveauNomFichier;
				}
				else {
					echo "L'importation n'a pas abouti";
				}
			}
			else {
				echo "Il y a une erreur dans le fichier importé.";
			}
		}
		else {
			echo "Vous ne pouvez pas importer un fichier de ce type. Les extensions autorisées sont jpg, jpeg et png.";
		}

	//Pour que ça marche, j'ai du donner les droits de lecture et écriture à tout le monde (everyone) du dossier contenant les photos importées (photosProf)
	




	//Modification du lien photo du prof
	function addPhoto($connection, $photo, $username2){
    $query = "UPDATE teachers SET photo =:photo WHERE login =:username";
    $statement = $connection->prepare($query);
    $statement->bindValue(":photo", $photo, PDO::PARAM_STR);
    $statement->bindValue(":username", $username2, PDO::PARAM_STR);

    $OK = $statement->execute();

    return ($OK);
  }

	function suppFichier (){
		if (strcmp($_SESSION["photo"], "noProfil.png") != 0){
			unlink("../photoProf/".$_SESSION["photo"]);
		}
	}


?>
</div>
</body>
</html>