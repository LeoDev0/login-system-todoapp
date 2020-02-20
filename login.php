<?php
require_once "config.php";
include "src/templates/header.php";
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
    echo '<script language="javascript">';
    echo 'alert("Usuário ou senha inválidos!")';
    echo '</script>';
  }
}
?>

<div class="login-container">
  <h1>Login</h1>

  <form method="post">
    <div class="form">
      <input type="text" name="user" placeholder=" " />
      <label for="user" class="label-name">
        <span class="content-name">Usuário</span>
      </label>
    </div>
    <div class="form">
      <input type="password" name="senha" placeholder=" " />
      <label for="senha" class="label-name">
        <span class="content-name">Senha</span>
      </label>
    </div>
    <button>Entrar</button>
  </form>
  <br>
  <a class="link" href="signup.php">Não tem conta? Faça uma.</a>
</div>

<?php
include "src/templates/footer.php";
?>
