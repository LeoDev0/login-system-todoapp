<?php
require_once "config.php";
include "src/templates/header.php";
session_start();
$id = $_SESSION['id'];

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $sql = "SELECT * FROM usuarios WHERE id = $id";
  $stmt = $pdo->query($sql);

  if ($stmt->rowCount() > 0) {
    header("Location: index.php");
  } else {
    session_destroy();
  }

} else {
  header("Location: index.php");
}
?>

<div style="text-align:center;" class="container">
  <h1>Conta deletada com sucesso!</h1>
  <h4>Uma pena... Sentiremos sua falta.</h4><br><br><br>
  <a href="signup.php">Quer criar outra conta?</a>
</div>

<?php
include "src/templates/footer.php";
?>