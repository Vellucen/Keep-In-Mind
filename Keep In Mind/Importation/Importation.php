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
	<meta name="description" content="Importation de photos"></meta>
	<meta name="keywords" content="Keep In Mind, importation, photo, nom, prénom, étudiant, ajouter, supprimer"></meta>
	<title>Importation</title>
	<script type="text/javascript"src="../jQuery/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/importation.js"></script>
	<link rel="stylesheet" href="../css/css.css"/>
</head>
<body>
	<header>
		<nav id="main_menu">
			<ul>
				<li id="logo" class="bouton1"><a id="logo"><img src="../image/logo.png"></a></li>
				<li id="id-profil" class="bouton1"><a><?php echo $firstname." ".$lastname; ?></a></li>
				<li class="bouton1"><a id="img-profil"><?php echo "<img src='../photoProf/$photo'>"; ?></a></li>
				<li class="bouton1 tombant"><a><img src="../image/parametre.png"></a>
					<ul>
						<li class="bouton2"><a href="../Parametres/parametres.php">Paramètres</a></li>
						<li class="bouton2"><a href="../Compte/Compte.php">Home</a></li>
						<li class="bouton2"><a class="verrou" href="../Jeu/jeu.php">Jouer</a></li>
						<li class="bouton2"><a href="../Importation/Importation.php">Importation</a></li>
						<li class="bouton2"><a href="../php/deconnexion.php">Déconnexion</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
	<div id="show">
		<div id="change" onclick="toChange()" method="post">Afficher par ordre de promotion</div>
		<div id="showPhoto"></div>
	</div>

	<div id="import">
		<form action="upload.php" method="post" enctype="multipart/form-data">
				<label for="prenom">Prénom de l'étudiant</label>
			  	<input type="text" id="prenomEtu" name="prenom" size="20"/>
		  		<label for="nom">Nom de l'étudiant</label>
		  		<div class="tooltipUp">
		 			<input type="text" id="nomEtu" name="nom"/>
		 			<span id="toolUp" class="tooltiptextUp">Cet étudiant est déjà dans la base de données.</span>
		 		</div>
		 		<label for="promotion">Promotion</label>
		 		<select id="promotion" name="promotion">
					<option id="L1_MIASHS">L1 MIASHS</option>
					<option id="L2_MIASHS">L2 MIAGE</option>
					<option id="L2_SC">L2 SC</option>
					<option id="L3_MIASHS">L3 MIAGE</option>
					<option id="L3_SC">L3 SC</option>
					<option id="M1_MIAGE">M1 MIAGE</option>
					<option id="M1_SC">M1 SC</option>
					<option id="M2_MIAGE">M2 MIAGE</option>
					<option id="M2_SC">M2 SC</option>
				</select>
				<label for="sexe">sexe</label>
				<select id="sexe" name="sexe">
					<option id="F">F</option>
					<option id="M">M</option>
				</select>

		 		<div class="boutonInput">
        		<input id="inputFile" type="file" name="file">
        		<button id="boutonImport" type="submit" name="submit">Importer</button>
        		</div>
		</form>
	</div>

	<div id="supprimerEtu">
		<form action="supprimerEtu.php" method="post">
			<div class="vide">
				<label for="prenom">Prénom de l'étudiant</label>
				<input type="text" id="prenomEtuSupp" name="prenom" size="20"/>
			</div>
			<div class="vide">
				<label for="nom">Nom de l'étudiant</label>
				<div class="tooltipUp">
					<input type="text" id="nomEtuSupp" name="nom"/>
					<span id="toolUp2" class="tooltiptextUp">Cet étudiant n'est pas dans la base de données. Suppression impossible.</span>
				</div>
			</div>
			
			<button id="boutonSupp" type="submit" name="supprimer">Supprimer</button>
		</form>
	</div>

	<footer>
		
	</footer>

</body>
</html>