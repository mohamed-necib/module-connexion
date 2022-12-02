<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php session_start();

  // Connection à la BDD
  require_once "./includes/bdd.php";
  if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];

    // RECUPERATION DE INFOS DU USER
    $sql = "SELECT * FROM utilisateurs WHERE login = '$login' ";
    $result = mysqli_query($conn, $sql);
    $displayUsers = mysqli_fetch_assoc($result);
  }
  //On update la base de données avec les nouvelles informations remplit par l'utilisateur.
  if (isset($_POST['envoyer'])) {
    $newLogin = $_POST['login'];
    $newPrenom = $_POST['prenom'];
    $newNom = $_POST['nom'];
    $newPassword = $_POST['password'];
    $newConf_pass = $_POST['conf_password'];
    // Hashage du mdp
    $passwordHash = password_hash($newPassword, PASSWORD_ARGON2ID);

    $errors = array();

    if (empty($newLogin) or empty($newPrenom) or empty($newNom) or empty($newPassword) or empty($newConf_pass)) {
      array_push($errors, "Tous les champs doivent être remplis");
    }
    if ($newPassword !== $newConf_pass) {
      array_push($errors, "Le mot de passe ne correspond pas");
    }

    if ($_SESSION['login'] != $newLogin or $password != $newPassword or $nom != $newNom or $prenom != $newPrenom) {
      $sql = "UPDATE `utilisateurs` SET login='$newLogin', password='$passwordHash', nom='$newNom', prenom='$newPrenom' WHERE login='$login'";
      $_SESSION['login'] = $newLogin;
      $_SESSION['password'] = $newPassword;
      header("Refresh:2");
      $result = mysqli_query($conn, $sql);
      /* var_dump($result); */
    } else {
      echo "Echec de modification";
    }
  }





  ?>
  <?php @include "./includes/header.php" ?>

  <!-- FORMULAIRE CHANGEMENT INFOS USER -->
  <main>
    <div class="form-container">
      <div class="form-logo">
        <img src="./assets/img/form-logo.png" alt="eye-logo">
      </div>
      <div class="form-logo-title">
        Hello <?= $_SESSION['login'] ?>
      </div>
      <form action="" method="POST" class="form">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" placeholder="<?= $displayUsers['login'] ?>" autocomplete="off" required>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" placeholder="<?= $displayUsers['prenom'] ?>" autocomplete="off" required>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="<?= $displayUsers['nom'] ?>" autocomplete="off" required>
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" autocomplete="off" required>
        <label for="conf_password">Confirmer Mot de passe</label>
        <input type="password" name="conf_password" id="conf_password" placeholder="Confirmer votre mot de passe" autocomplete="off" required>
        <input class="button" type="submit" value="Modifier" name="envoyer">
      </form>
  </main>
  <?php @include "./includes/footer.php" ?>
</body>

</html>