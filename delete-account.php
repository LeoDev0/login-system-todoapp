<?php
require_once "config.php";
include "src/templates/header.php";
session_start();
$id = $_SESSION['id'];

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $sql = "SELECT * FROM usuarios WHERE id = $id";
  $dados = $pdo->query($sql)->fetch();
} else {
  header("Location: index.php");
}

if (isset($_POST['senha']) && !empty($_POST['senha'])) {
  $confirmPassword = md5($_POST['senha']);
  
  if ($confirmPassword === $dados['senha']) {
    $sql = "DELETE FROM usuarios WHERE id = :id;
            DELETE FROM todos WHERE user_id = :userId";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":userId", $id);
    $stmt->execute();

    // deleta a imagem de perfil caso ela não seja a padrão
    if ($dados['profile_pic'] !== "default-profile.png") {
      unlink("src/images/profile-photo/" . $dados['profile_pic']);
    }

    header("Location: deletion-confirmation.php");
  } else {
    echo '<script language="javascript">';
    echo 'alert("Senha incorreta!")';
    echo '</script>';
  }
}

?>

<div class="upper-nav">
  <a style="color:blue;" class="white-box" href="settings.php">↩️  Voltar</a>
</div>
<br><br><br>

<div class="container">
  <form class="delete-form" method="post">
    <label for="senha">Digite sua senha</label><br>
    <input type="password" name="senha">
    <button style="margin-top: 25px;" class="btn delete delete-account-btn">Confirmar deleção</button>
  </form>
</div>

<script src="src/js/confirm-deletion.js"></script>
<?php
include "src/templates/footer.php";
?>