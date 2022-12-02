<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceuil</title>
</head>

<body>
  <?php @include "./includes/header.php" ?>
  <main>
    <?php if (isset($_SESSION['login'])) : ?>
      <h1>
        HELLO 
        <span style="color: #89babf;"><?php echo ucwords($_SESSION['login']) ?></span>
      </h1>
    <?php else : ?>
      <h1>HELLO Who Are You?</h1>
    <?php endif; ?>
  </main>
  <?php @include "./includes/footer.php" ?>



</body>


</html>