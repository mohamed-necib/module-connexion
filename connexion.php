<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
</head>

<body>
  <?php @include "./includes/header.php" ?>
  <main>
    <div class="form-container connexion">
      <?php
      session_start();

      if (isset($_POST['connexion'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];


        //Connexion à la base de donnée
        require_once "includes/bdd.php";
        $sql = "SELECT * FROM utilisateurs WHERE login= '$login'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);



        if ($user['login'] === "admin") {
          if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = "admin";
            echo "Vous etes bien connecté en tant qu'Admin";
            header("Refresh:0.1 url=admin.php");
            die();
          }
        }
        if ($user) {
          if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = $login;
            echo "Connexion reussie";
            header("Refresh:0.1 url=profil.php");
            die();
          } else {
            echo "Mot de Passe invalide";
          }
        } else {
          echo "Le Login n'existe pas - Veuillez vous créer un compte";
        }
      }
      ?>
      <div class="form-logo">
        <img src="./assets/img/form-logo.png" alt="eye-logo">
      </div>
      <div class="form-logo-title">
        Connexion
      </div>
      <form action="connexion.php" method="POST" class="form">

        <label for="login">Login</label>
        <input type="login" name="login" placeholder="Entrer votre login" autocomplete="off" required>

        <label for="password">Mot de Passe</label>
        <input type="password" name="password" placeholder="Entrer votre mot de passe" autocomplete="off" required>

        <input class="button" type="submit" value="Se connecter" name="connexion">
      </form>
    </div>
  </main>
  <?php @include "./includes/footer.php" ?>

</body>

</html>