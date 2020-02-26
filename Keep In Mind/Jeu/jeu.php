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
	<meta name="description" content="Jeu de mémorisation de nom"></meta>
	<meta name="keywords" content="Keep In Mind, jeu"></meta>
	<title>Jeu</title>
	<link rel="stylesheet" href="../css/css.css"/>
	<script type="text/javascript"src="../jQuery/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/jeu.js"></script>
</head>
<body>
	<div id="retour"><a href="../Compte/compte.php">Retour</a></div>
	<div id="cadreJeu">
		<img id="photo" src="../image/imageDepart.png">
		<div id="divBouton">
			<button class="boutonJeu" onclick="verifNom1()" id="nom1">Démarrer</button>
			<button class="boutonJeu" onclick="verifNom2()" id="nom2" style="visibility: hidden;">Démarrer</button>
		</div>
	</div>
	<div id ="barre"></div>
</body>
</html>