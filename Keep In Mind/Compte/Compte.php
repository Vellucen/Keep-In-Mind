<?php 
	session_start();

	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$username = $_SESSION["username"];
	$mail = $_SESSION["mail"];
	$photo = $_SESSION["photo"];
	$score = $_SESSION["score"];

/*la vérification "if ($firstname)" sert à savoir si une personne est connectée ou non. Si personne n'est connecté alors la variable est undefined donc la condition n'est pas vérifiée*/
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
	<meta name="description" content="Compte professeur personnel"></meta>
	<meta name="keywords" content="Keep In Mind, compte, jouer, importer"></meta>
	<title>Compte</title>
	<link rel="stylesheet" href="../css/css.css"/>
	<script type="text/javascript"src="../jQuery/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/tableauScore.js"></script>
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

	<aside id="score">
		<h3>Classement Compétitif</h3>
	</aside>

	<main>

		<div id="importer">
			<a href="../Importation/Importation.php">IMPORTER</a>
		</div>
		<div id="Spas"></div>
		<div id="jouer">
			<a class="verrou" href="../Jeu/jeu.php">JOUER</a>
		</div>

	</main>

	<div id="parametres" style="visibility: hidden;">/*en php*/
		
	</div>

	<footer>
		
	</footer>

</body>
</html>