<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="flex.css">
  <title>Admin Page</title>
</head>

<body>
  <?php
  session_start();
  /* var_dump($_SESSION); */
  if (!isset($_SESSION['login'])) {
    header("Location: connexion.php");
    exit;
  }

  @include "./includes/header.php";
  if ($_SESSION['login'] === "admin") {
    require_once "includes/bdd.php";
    $sql = "SELECT * FROM utilisateurs";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result);
  } else {
    header("Location: connexion.php");
    exit;
  }
  ?>
  <main style="display: flex; flex-direction: column">
    <h1>Hello <span style="color: #89babf;"><?= $_SESSION['login'] ?></span></h1>
    <table border="1px" width="50vw" align="center">
      <thead>
        <th>ID</th>
        <th>LOGIN</th>
        <th>PRÉNOM</th>
        <th>NOM</th>
        <th>MOT DE PASSE</th>
      </thead>
      <tbody>
        <?php
        foreach ($user as $ligne) {
          echo "<tr>";
          foreach ($ligne as $value) {
            echo "<td>" . $value;
          }
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </main>

  <?php @include "./includes/footer.php" ?>
</body>

</html>