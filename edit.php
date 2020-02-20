<?php
require_once "config.php";
include "src/templates/header.php";
session_start();

$id = $_GET['id'];
$user_id = $_SESSION['id'];

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $sql = "SELECT * FROM todos WHERE id = :id AND user_id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id", $id);
  $stmt->bindValue(":user_id", $user_id);
  $stmt->execute();
  $todo = $stmt->fetch();

} else {
  header("Location: index.php");
}

if (isset($_POST['todo-alterado']) && !empty($_POST['todo-alterado'])) {
  $todoAlterado = $_POST['todo-alterado'];

  $sql = "UPDATE todos SET todo = :todoAlterado WHERE id = :id AND user_id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":todoAlterado", $todoAlterado);
  $stmt->bindValue(":id", $id);
  $stmt->bindValue(":user_id", $user_id);
  $stmt->execute();

  header("Location: index.php");
}
?>

<div class="upper-nav">
  <a style="color:blue;" class="white-box" href="index.php">↩️  Voltar</a>
</div>
<br><br><br>

<div class="container">
  <form method="post" class="todo-form">
    <div class="form">
        <input type="text" name="todo-alterado" placeholder=" " value="<?= $todo['todo'] ?>"/>
        <label for="todo-alterado" class="label-name">
          <span class="content-name"></span>
        </label>
    </div>
    <button class="btn submit">Salvar</button>
  </form>
</div>

<?php
include "src/templates/footer.php";
?>