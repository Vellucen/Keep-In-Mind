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
	<meta name="description" content="Paramètres"></meta>
	<meta name="keywords" content="Keep In Mind, paramètres, modifier, supprimer"></meta>
	<title>Paramètres</title>
	<link rel="stylesheet" href="../css/css.css"/>
	<script type="text/javascript"src="../jQuery/jquery-3.3.1.js"></script>
</head>
<body>
	<div id="retour"><a href="../Compte/compte.php">Retour</a></div>

	<div id="divParametre">
	<div id="modifier">
		<h2>Modification</h2>
		<form action="verifModification.php" method="post">
			<input type="text" id="trueUsername" name="trueUsername" value="<?php echo $username; ?>" style="visibility: hidden;" />
          	<div class="champs tooltip">
	            <label for="firstname">Prénom</label>
	            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" size="20"/>
	            <span id="tooltip0" class="tooltiptext">Le prénom doit contenir 1 caractère au minimum</span>
          	</div>

	        <div class="champs tooltip">
		        <label for="lastname">Nom</label>
		        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" size="20"/>
		        <span id="tooltip0bis" class="tooltiptext">Le nom doit contenir 1 caractère au minimum</span>
	        </div>

        	<div class="champs tooltip">
        		<label for="username">Login</label>
        		<input type="text" id="username" name="username" value="<?php echo $username; ?>" size="20"/>
        		<span id="tooltip1" class="tooltiptext">Le login doit contenir 4 caractères au minimum</span>
        		<span id="tooltip1bis" class="tooltiptext">Ce login est déjà utilisé</span>
        	</div>
        	<div class="champs tooltip">
        		<label for="password">Mot de passe</label>
    			<input type="password" id="password" name="password"/>        
        		<span id="tooltip2" class="tooltiptext">Le mot de passe doit contenir 6 caractères au minimum</span>
          	</div>
        	<div class="champs tooltip">
    			<label for="confirmPassword">Confirmation du mot de passe</label>
    			<input type="password" id="confirmPassword" name="confirmPassword"/>
            <span id="tooltip3" class="tooltiptext">Les mots de passe ne sont pas identiques</span>
        	</div>
        	<div class="champs tooltip">
        		<label for="mail">Adresse email</label>
        		<input type="text" id="mail" name="mail" value="<?php echo $mail; ?>" size="35"/>
        		<span id="tooltip4" class="tooltiptext">L'adresse email n'est pas valide</span>
        	</div>
        	<div class="boutonInput">
        		<input id="boutonInscription" type="submit" value="Modifier" disabled="true" />
        	</div>
    	</form>
	</div>
	<div id="supprimer">
		Supprimer votre compte Keep In Mind.
		<button onclick="affichSupp()">Supprimer</button>
	</div>
	<div id="ajouter">
		<form action="uploadImage.php" method="post" enctype="multipart/form-data">
			Ajouter une photo pour changer votre image de profil.
			<input id="inputFile" type="file" name="file">
			<button id="boutonChanger" type="submit" name="boutonChanger">Changer</button>
		</form>
	</div>
	
	<div id="confirmSupp">
		Etes vous sur de vouloir faire ça ? Une fois votre compte supprimé toutes vos informations seront perdues.
		<div id="delete">
			<a href="verifSupp.php">SUPPRIMER</a>
		</div>
		<button onclick="cacheSupp()">Non</button>
	</div>
	</div>
	<script type="text/javascript" src="../js/verifParametre.js"></script>
</body>
</html>