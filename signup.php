<link rel="stylesheet" href="css/style.css">

<?php
require_once "config.php";
session_start();

if (isset($_POST['user']) && !empty($_POST['user'])) {
  $nome = $_POST['user'];
  $senha = md5($_POST['senha']);
  
  $sql = "INSERT INTO usuarios VALUES (null, :nome, :senha)";
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(":nome", $nome);
  $stmt->bindValue(":senha", $senha);
  $stmt->execute();

  // pegando imediatamente o id dado pro usuário pelo mysql e já redirecionando o usuário pra página do usuário 
  $id = $pdo->lastInsertId();
  $_SESSION['id'] = $id;
  header("Location: index.php");
}
?>

<div class="container">

  <form method="post">
    <label for="user">Usuário</label><br>
    <input type="text" name="user" placeholder="Defina nome de usuário"><br><br>
    <label for="senha">Senha</label><br>
    <input type="password" name="senha" placeholder="Defina sua senha"><br><br>
    <button>Signup</button>
  </form>
  <br>
  <a href="login.php">Já tem conta? Faça login.</a>

</div>