<?php
   try{
    $tabDonnee = array();
    $connection = new PDO("mysql:host=localhost;dbname=projet","root");
    $connection->exec("SET NAMES 'utf8'");
    $username = $connection->query("SELECT login FROM teachers");
    $tabDonnee = $username->fetchAll();
    echo json_encode($tabDonnee, JSON_UNESCAPED_SLASHES);
    $connection = null;
  }
  catch (PDOException $e){
    echo $e -> getMessage();
  }
?>