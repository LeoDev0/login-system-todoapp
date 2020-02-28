<!-- Renomeie este arquivo para "config.php" e adicione abaixo as credenciais do seu banco de dados -->

<?php
$dbuser = "";
$dbpass = "";
$dbname = "";
$host = "";
$dsn = "mysql:dbname=$dbname;host=$host";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Essas opções mostram mais detalhadamente os erros quando eles aparecerem. OBS: não habilitar isso em produção para não mostrar mensagens de erro no servidor aos usuário!

try {
  $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (PDOException $e) {
  die('Erro: ' . $e->getMessage());
}
?>