<?php
	try {
		$tab = array();

		$connection = new PDO("mysql:host=localhost;dbname=projet","root");
		$connection->exec("SET NAMES 'utf8'");
		$query = "SELECT lastname,firstname,score FROM teachers ORDER BY score DESC";
		$results = $connection->query($query);
		$tab = $results->fetchAll();
		echo json_encode($tab, JSON_UNESCAPED_SLASHES);
		$connection = null;
	}
	catch (PDOException $e){
		echo $e -> getMessage();
	}
?>