<!-- Une page contenant un formulaire d’inscription (inscription.php) :
Le formulaire doit contenir l’ensemble des champs présents dans la table
“utilisateurs” (sauf “id”) + une confirmation de mot de passe. Dès qu’un
utilisateur remplit ce formulaire, les données sont insérées dans la base de
données et l’utilisateur est redirigé vers la page de connexion. -->
<?php
session_start();
if (isset($_SESSION["login"])) {
  header("Location: profil.php");
  exit;
}

if (isset($_POST['envoyer'])) {
  $login = $_POST['login'];
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $password = $_POST['password'];
  $conf_pass = $_POST['conf_password'];

  // Hashage du mdp
  $passwordHash = password_hash($password, PASSWORD_ARGON2ID);

  $errors = array();

  if (empty($login) or empty($prenom) or empty($nom) or empty($password) or empty($conf_pass)) {
    array_push($errors, "Tous les champs doivent être remplis");
  }
  if ($password !== $conf_pass) {
    array_push($errors, "Le mot de passe ne correspond pas");
  }

  //Connexion a la BDD
  require_once "includes/bdd.php";

  //Check si déja existant
  $sql = "SELECT * FROM utilisateurs WHERE login='$login'";
  $result = mysqli_query($conn, $sql);
  $rowCount = mysqli_num_rows($result);
  if ($rowCount > 0) {
    array_push($errors, "Le Login existe déjà");
  }

  if (count($errors) > 0) {
    foreach ($errors as $error) {
      echo "<div class='alert alert-danger'>$error</div>";
    }
  } else {

    //Ajout du nouvel utilisateur
    $sql = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES ( ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareStmt) {
      mysqli_stmt_bind_param($stmt, "ssss", $login, $prenom, $nom, $passwordHash);
      mysqli_stmt_execute($stmt);
      echo "<div class='alert alert-success'>Vous êtes bien inscrit</div>";
      header("Location: connexion.php");
    } else {
      die("Une erreur sauvage est apparue");
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/CSS/form.css">
  <title>Inscription Form</title>
</head>

<body>
  <?php include './includes/header.php'; ?>
  <main>
    <div class="form-container">
      <div class="form-logo">
        <img src="./assets/img/form-logo.png" alt="eye-logo">
      </div>
      <div class="form-logo-title">
        Inscription
      </div>
      <form action="" method="POST" class="form">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" placeholder="Entrer votre login" autocomplete="off" required>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom" autocomplete="off" required>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" autocomplete="off" required>
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" autocomplete="off" required>
        <label for="cpassword">Confirmer Mot de passe</label>
        <input type="password" name="conf_password" id="cpassword" placeholder="Confirmer mot de passe" autocomplete="off" required>
        <input class="button" type="submit" value="S'inscrire" name="envoyer">
      </form>
  </main>
  <?php include './includes/footer.php'; ?>
  </div>

</body>

</html>