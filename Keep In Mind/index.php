<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="icon" type="image/png" href="image/icone.png" />
  <meta charset="utf-8"></meta>
  <meta name="description" content="Connexion ou Inscription"></meta>
  <meta name="keywords" content="Keep In Mind, connexion, inscription"></meta>
  <title>Keep In Mind - Connexion ou Inscription</title>
  <link rel="stylesheet" href="css/css.css"/>
  <script type="text/javascript" src="jQuery/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="js/verifForm.js"></script>
</head>

<body>
  
  <img id="titre" src="image/logo.png">
	
  <!-- Connexion -->
    <div id="connexion">
      <form action="php/verifConnexion.php" method="post">
        <div class="champs">
          <label for="usernameConnex">Nom d'utilisateur</label>
          <input type="text" id="usernameConnex" name="usernameConnex" size="20"/>
        </div>
        <div class="champs">
          <label for="passwordConnex">Mot de passe</label>
    			<input type="password" id="passwordConnex" name="passwordConnex"/>
        </div>
        <div class="boutonInput">
          <input id="boutonConnex" type="submit" value="Connexion"/>
        </div>
    	</form>
  	</div>

  <!-- Inscription -->
  	<div id="inscription">
      <h2>Inscription</h2>
  		  <form action="php/verifInscription.php" method="post">

          <div class="champs tooltip">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" size="20"/>
            <span id="tooltip0" class="tooltiptext">Le prénom doit contenir 1 caractère au minimum</span>
          </div>

          <div class="champs tooltip">
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" size="20"/>
            <span id="tooltip0bis" class="tooltiptext">Le nom doit contenir 1 caractère au minimum</span>
          </div>

          <div class="champs tooltip">
            <label for="username">Login</label>
            <input type="text" id="username" name="username" size="20"/>
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
            <input type="text" id="mail" name="mail" size="35"/>
            <span id="tooltip4" class="tooltiptext">L'adresse email n'est pas valide</span>
          </div>
          <div class="boutonInput">
            <input id="boutonInscription" type="submit" value="S'inscrire" disabled="true" />
          </div>
    	</form>
  	</div>
</body>
</html>