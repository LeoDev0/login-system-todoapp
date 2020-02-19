<?php
require_once "config.php";
session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $id = $_SESSION['id'];

  $sql = "SELECT * FROM usuarios WHERE id = $id";
  $dados = $pdo->query($sql)->fetch();

} else {
  header("Location: login.php");
  exit;
}

include "templates/header.php";

$sql = "SELECT * FROM todos WHERE user_id = $id ORDER BY id DESC";
$stmt = $pdo->query($sql);
?>

<div class="upper-nav">
  <h3>Seja bem-vindo, <?= $dados['nome'] ?></h3>
  <a href="logout.php">Logout
    <i class="fas fa-sign-out-alt"></i>
  </a>
</div>

<div class="container">
  <h2>My ToDo's</h2>
  <br>
  <form method="post" class="todo-form">
    <input type="text" name="todo" class="todo-input" placeholder="Adicionar tarefa">
    <button class="btn submit">Adicionar</button>
  </form>
  <br>
  <ul>
  <?php
  if ($stmt->rowCount() > 0) {
    foreach ($stmt->fetchAll() as $post) {
      echo '<li>';
      echo '<div class="task">';
        echo $post['todo'];
      echo '</div>';
      echo '<div class="actions">';
        echo '<a class="btn delete" href="delete.php?id=' . $post['id'] . '"> <i class="far fa-trash-alt"></i> </a>  ';
        echo '<a class="btn edit" href="edit.php?id=' . $post['id'] . '"> <i class="far fa-edit"></i> </a>';
      echo '</div>';
    echo '</li>';
    echo '<br />';
    echo '<br />';
    }
  } else {
    // echo "<center>Ainda não há ToDos!</center>";
    echo "Ainda não há ToDos!";
  }
  ?>
  </ul>
</div>

<?php
if (isset($_POST['todo']) && !empty($_POST['todo'])) {
  $todo = $_POST['todo'];

  $sql = "INSERT INTO todos VALUES (null, :todo, :user_id)";
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(":todo", $todo);
  $stmt->bindValue(":user_id", $id);
  $stmt->execute();

  header("Location: index.php");
}
?>

<script src="https://kit.fontawesome.com/6497846d4f.js" crossorigin="anonymous"></script>
<?php
include "templates/footer.php";
?>
