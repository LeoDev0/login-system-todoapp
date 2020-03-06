<?php
include "src/templates/header.php";
require_once "config.php";
session_start();
$id = $_SESSION['id'];

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $sql = "SELECT * FROM usuarios WHERE id = $id";
  $dados = $pdo->query($sql)->fetch();  
} else {
  header("Location: index.php");
}

if (isset($_FILES['submit-photo']) && !empty($_FILES['submit-photo'])) {
  $foto = $_FILES['submit-photo'];

  // Verificando se o arquivo escolhido para imagem de perfil é realmente uma 
  // imagem (apenas as extensões ".jpg", ".jpeg" e ".png" são permitidas)
  $allowedFileTypes = ['image/png', 'image/jpeg', 'image/jpg'];
  if (in_array($foto['type'], $allowedFileTypes)) {
    $nomeDoArquivo = "user_id" . $id . ".jpg";
    move_uploaded_file($foto['tmp_name'], 'src/images/profile-photo/' . $nomeDoArquivo);

    $sql = "UPDATE usuarios SET profile_pic = :nomeDoArquivo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":nomeDoArquivo", $nomeDoArquivo);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    header("Location: settings.php");

  } else {
    echo '<script language="javascript" >';
    echo 'alert("Apenas arquivos de imagem jpg/jpeg/png são permitidos!")';
    echo '</script>';
  }
}

if (isset($_POST['old-pass']) && !empty($_POST['old-pass'])) {
  $oldPasswordInput = md5($_POST['old-pass']);

  if (isset($_POST['new-pass']) && !empty($_POST['new-pass'])) {
    $newPassword = md5($_POST['new-pass']);

    if ($oldPasswordInput === $dados['senha']) {
      $sql = "UPDATE usuarios SET senha = :novaSenha WHERE id = :id";
      $stmt = $pdo->prepare($sql);
  
      $stmt->bindValue(":novaSenha", $newPassword);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
  
      echo '<script language="javascript">';
      echo 'alert("Senha alterada com sucesso!")';
      echo '</script>';
      // header("Location: index.php");
  
    } else {
      echo '<script language="javascript">';
      echo 'alert("Senha antiga incorreta!")';
      echo '</script>';
    }
  } else {
    echo '<script language="javascript">';
    echo 'alert("Digite a nova senha.")';
    echo '</script>';
  }
}
?>

<link rel="stylesheet" href="src/css/settings.css">

<div class="upper-nav">
  <a style="color:blue;" class="white-box" href="index.php">↩️  Voltar</a>
  <a style="color:white; text-decoration:none;" class="delete-account-btn btn delete" href="delete-account.php">Deletar conta</a>
</div>
<br><br><br>

<div class="container">
  <div class="settings-box">
    <div class="change-pass-box">
      <h3>Trocar senha</h3>
      <form id="pass-change-form" class="change-pass-box normal-input" method="post">
        <label for="old-pass">Senha atual:</label><br>
        <input type="password" name="old-pass">
        <label for="new-pass">Nova senha:</label><br>
        <input type="password" name="new-pass">
        <label for="repeat-new-pass">Confirmar nova senha:</label><br>
        <input type="password" name="repeat-new-pass">
      </form>
    </div>
    <div class="change-photo-box">
      <img src="src/images/profile-photo/<?= $dados['profile_pic'] ?>">
      <form id="profile-photo-form" method="post" enctype="multipart/form-data">
        <input onchange="this.form.submit()" hidden class="submit-profile-photo" type="file" name="submit-photo" accept=".png, .jpg, .jpeg">
      </form>
      <button id="change-photo-btn" class="btn edit">Trocar foto</button>
    </div>
  </div>
  <div style="text-align: center; margin: 40px 0;">
    <button form="pass-change-form" class="btn submit">Salvar Alterações</button>
  </div>
</div>

<script src="src/js/settings-page.js"></script>
<?php
include "src/templates/footer.php";
?>