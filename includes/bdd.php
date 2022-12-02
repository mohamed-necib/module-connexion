<?php

$hostName = "localhost";
$dbUSer = "root";
$dbPassword = "root";
$dbName = "moduleconnexion";

$conn=mysqli_connect($hostName, $dbUSer, $dbPassword, $dbName);

if(!$conn) {
  die("La connexion a échouée");
}

?>