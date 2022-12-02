<?php

// DECONNEXION
// Supression de la variable de Session
session_start();
// $_SESSION = [];
if (!isset($_SESSION['login'])) {
  header("Location: ../connexion.php");
  exit;
}
$_SESSION = [];
unset($_SESSION['login']);
session_destroy();
header("Location: ../index.php");
