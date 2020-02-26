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
  <meta name="description" content="Finalisation de l'inscription"></meta>
  <meta name="keywords" content="Keep In Mind, finalisation, inscription, finalisation de l'inscription"></meta>
  <title>Keep In Mind - Finalisation de l'Inscription</title>
  <link rel="stylesheet" href="../css/css.css"/>
  <script type="text/javascript" src="../jQuery/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="../js/finalInscription.js"></script>
</head>
<body>
	<div id="final">
		<p>Votre inscription est presque terminée. Il ne vous reste plus qu'à choisir les classes dans lesquelles vous faites cours.</p>
    	<form action="verifFinalInscription.php" method="post">
        <div class="finalChamps">
        	<input id="check1" type="checkbox" name="promotion[]" value="L1 MIASHS"/><label>L1 MIASHS</label>
        </div>
        <div class="finalChamps">
        	<input id="check2" type="checkbox" name="promotion[]" value="L2 MIAGE"/><label>L2 MIAGE</label>
        	<input id="check3" type="checkbox" name="promotion[]" value="L2 SC"/><label>L2 SC</label>
        </div>
        <div class="finalChamps">
        	<input id="check4" type="checkbox" name="promotion[]" value="L3 MIAGE"/><label>L3 MIAGE</label>
        	<input id="check5" type="checkbox" name="promotion[]" value="L3 SC"/><label>L3 SC</label>
        </div>
        <div class="finalChamps">
        	<input id="check6" type="checkbox" name="promotion[]" value="M1 MIAGE"/><label>M1 MIAGE</label>
        	<input id="check7" type="checkbox" name="promotion[]" value="M1 SC"/><label>M1 SC</label>
        </div>
        <div class="finalChamps">
        	
        	<input id="check8" type="checkbox" name="promotion[]" value="M2 MIAGE"/><label>M2 MIAGE</label>
        	<input id="check9" type="checkbox" name="promotion[]" value="M2 SC"/><label>M2 SC</label>
        </div>
            <input id="boutonFinalInscription" type="submit" value="Finaliser" disabled="true" />
		</form>
  	</div>
</body>
</html>