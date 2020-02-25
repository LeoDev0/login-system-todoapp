<?php
require_once "config.php";
include "src/templates/header.php";
session_start();

if (isset($_POST['user']) && !empty($_POST['user']))  {
  $nome = $_POST['user'];

  if (isset($_POST['senha']) && !empty($_POST['senha'])) {
    $senha = md5($_POST['senha']);
    $sql = "INSERT INTO usuarios VALUES (null, :nome, :senha, default)";
    $stmt = $pdo->prepare($sql);
  
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();
  
    // pegando imediatamente o id dado pro usuário pelo mysql e já redirecionando o usuário pra página do usuário 
    $id = $pdo->lastInsertId();
    $_SESSION['id'] = $id;
    header("Location: index.php");
  } else {
    echo '<script language="javascript">';
    echo 'alert("Escolha uma senha")';
    echo '</script>';
  }
}
?>

<div class="bg-image-signup">

  <div class="login-container">
    <h1>Sign Up</h1>
  
    <form method="post" id="signup-form">
      <div class="form">
        <input type="text" name="user" placeholder=" " />
        <label for="user" class="label-name">
          <span class="content-name">Defina nome de usuário</span>
        </label>
      </div>
      <div class="form">
        <input type="password" name="senha" placeholder=" " />
        <label for="senha" class="label-name senha">
          <span class="content-name">Defina a senha</span>
        </label>
      </div>
      <div class="form">
        <input type="password" name="senha-repetida" placeholder=" " />
        <label for="senha-repetida" class="label-name senha">
          <span class="content-name">Repita a senha</span>
        </label>
      </div>
      <button>Registrar</button>
    </form>
    <br>
    <a href="login.php">Já tem conta? Faça login.</a>
  </div>

</div>


<script src="src/js/signup-page.js"></script>
<?php
include "src/templates/footer.php";
?>