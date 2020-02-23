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

include "src/templates/header.php";

$sql = "SELECT * FROM todos WHERE user_id = $id ORDER BY id DESC";
$stmt = $pdo->query($sql);
?>

<div class="upper-nav">
  <div class="profile-div">
    <form action="submit-file.php" method="post" enctype="multipart/form-data">
      <input class="submit-profile-photo" type="file" name="submit-photo"> 
      <button class="submit-profile-photo"></button>
    </form>
    <img class="profile-photo" src="src/images/profile-photo/<?= $dados['profile_pic'] ?>" title="Trocar foto de perfil">
    <h3><?= $dados['nome'] ?></h3>
  </div>
  <a class="white-box" href="logout.php">Logout
    <i class="fas fa-sign-out-alt"></i>
  </a>
</div>

<div class="container">
  <h2>Minhas Tarefas</h2>
  <br>
  <form method="post" class="todo-form">
    <div class="form">
      <input type="text" name="todo" placeholder=" ">
      <label for="todo" class="label-name">
        <span class="content-name">Adicionar tarefa</span>
      </label>
    </div>
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
    echo "Ainda não há tarefas!";
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
<script src="src/js/index-page.js"></script>
<?php
include "src/templates/footer.php";
?>
