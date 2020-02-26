<?php 

	session_start();

	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	
	$tab = array($firstname,$lastname);

	echo json_encode($tab, JSON_UNESCAPED_SLASHES);

?>
