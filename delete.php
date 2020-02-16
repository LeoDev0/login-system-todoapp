<?php
require_once "config.php";
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
  $user_id = $_SESSION['id'];

  $sql = "DELETE FROM todos WHERE id = :id AND user_id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id", $id);
  $stmt->bindValue(":user_id", $user_id);
  $stmt->execute();

  header("Location: index.php");
} else {
  header("Location:index.php");
}
?>