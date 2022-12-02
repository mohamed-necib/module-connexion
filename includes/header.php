<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/flex.css">
  <title>Acceuil</title>
</head>

<body>
  <nav class="navbar">
    <a href="/../module-connexion/index.php" class="logo"><img src="./assets/img/logo.svg" alt=""></a>
    <div class="nav-links">
      <ul>
        <li class="active"><a href="/../module-connexion/index.php">Accueil</a></li>
        <?php if (!isset($_SESSION['login'])) : ?>
          <li><a href="/../module-connexion/connexion.php">Connexion</a></li>
          <li><a href="/../module-connexion/inscription.php">Inscription</a></li>
        <?php else : ?>
          <li><a href="/../module-connexion/includes/deconnect.php">Deconnexion</a></li>
        <?php endif; ?>
      </ul>
    </div>
    <img src="./assets/img/burger-menu.png" alt="menu-burger" class="menu-burger">
  </nav>
</body>
<script>
  const menuHamburger = document.querySelector(".menu-burger")
  const navLinks = document.querySelector(".nav-links")

  menuHamburger.addEventListener('click', () => {
    navLinks.classList.toggle('mobile-menu')
  })
</script>

</html>