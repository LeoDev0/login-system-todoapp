<?php
require_once "config.php";
session_start();
$id = $_SESSION['id'];
$foto = $_FILES['submit-photo'];

if (isset($foto['tmp_name']) && !empty($foto['tmp_name'])) {
  $fileExtension = substr($foto['name'], -4, 4);
  $nomeDoArquivo = "user_id" . $id . $fileExtension;
  move_uploaded_file($foto['tmp_name'], 'src/images/profile-photo/' . $nomeDoArquivo);

  $sql = "UPDATE usuarios SET profile_pic = :nomeDoArquivo WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":nomeDoArquivo", $nomeDoArquivo);
  $stmt->bindValue(":id", $id);
  $stmt->execute();

  header("Location: index.php");
} else {
  header("Location: index.php");
}
?>