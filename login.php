<link rel="stylesheet" href="css/style.css">

<?php

require_once "config.php";
session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  header("Location: index.php");
}

if (isset($_POST['user']) && !empty($_POST['user'])) {
  $nome = $_POST['user'];
  $senha = md5($_POST['senha']);

  // $sql = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
  // $stmt = $pdo->query($sql);
  $sql = "SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha";

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":nome", $nome);
  $stmt->bindValue(":senha", $senha);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $dados = $stmt->fetch();
    $_SESSION['id'] = $dados['id'];

    header("Location: index.php");
  } else {
    echo "usuário inválido";
  }
}
?>

<div class="container">

  <form method="post">
    <label for="user">Usuário</label><br>
    <input type="text" name="user"><br><br>
    <label for="senha">Senha</label><br>
    <input type="password" name="senha"><br><br>
    <button>Login</button>
  </form>
  <br>
  <a href="signup.php">Não tem conta? Faça uma.</a>

</div>