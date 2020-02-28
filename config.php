<?php
$dbuser = "root";
$dbpass = "";
$dbname = "login";
$host = "localhost";
$dsn = "mysql:dbname=$dbname;host=$host";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Essas opções mostram mais detalhadamente os erros quando eles aparecerem. OBS: não habilitar isso em produção para não mostrar mensagens de erro no servidor aos usuário!

try {
  $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (PDOException $e) {
  die('Erro: ' . $e->getMessage());
}
?>