<?php
include "src/templates/header.php";
session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  session_destroy();
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