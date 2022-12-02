<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/flex.css">

</head>

<body>
  <footer>
    <div class="social">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="https://github.com/mohamed-necib/module-connexion.git"><i class="fab fa-github"></i></a>
      <a href="https://www.linkedin.com/in/mohamed-el-amine-necib-9178a417b/"><i class="fab fa-linkedin"></i></a>
    </div>
    <ul class="list">
        <li><a href="/../module-connexion/index.php">Accueil</a></li>
        <?php if (!isset($_SESSION['login'])) : ?>
          <li><a href="/../module-connexion/connexion.php">Connexion</a></li>
          <li><a href="/../module-connexion/inscription.php">Inscription</a></li>
        <?php else : ?>
          <li><a href="/../module-connexion/includes/deconnect.php">Deconnexion</a></li>
        <?php endif; ?>
      </ul>
    <p class="copyright">
      Ntik/Dev - 2022 ©
    </p>
  </footer>
</body>

</html>