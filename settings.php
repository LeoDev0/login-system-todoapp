<?php
include "src/templates/header.php";
require_once "config.php";
session_start();
$id = $_SESSION['id'];

// $directory = "src/images/profile-photo/";
// $filecount = 0;
// $files = glob($directory . "*");
// print_r($files[0]);
// if ($files){
//  $filecount = count($files);
// }
// echo "There were $filecount files";

// unlink("src/images/profile-photo/user_id21.png");


if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $sql = "SELECT * FROM usuarios WHERE id = $id";
  $dados = $pdo->query($sql)->fetch();  
} else {
  header("Location: index.php");
}

if (isset($_FILES['submit-photo']) && !empty($_FILES['submit-photo'])) {
  $foto = $_FILES['submit-photo'];
  // $fileExtension = substr($foto['name'], -4, 4);
  // $nomeDoArquivo = "user_id" . $id . $fileExtension;
  $nomeDoArquivo = "user_id" . $id . ".jpg";
  move_uploaded_file($foto['tmp_name'], 'src/images/profile-photo/' . $nomeDoArquivo);

  $sql = "UPDATE usuarios SET profile_pic = :nomeDoArquivo WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":nomeDoArquivo", $nomeDoArquivo);
  $stmt->bindValue(":id", $id);
  $stmt->execute();

  header("Location: settings.php");
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
      <form id="pass-change-form" class="change-pass-box" method="post">
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
        <input onchange="this.form.submit()" hidden class="submit-profile-photo" type="file" name="submit-photo">
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