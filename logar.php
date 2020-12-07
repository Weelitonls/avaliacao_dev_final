<?php
require_once('Conexao.php');
$db = new Conexao();
$link = $db->setConexao();
session_start();
$login = isset($_POST['login']) ? trim($_POST['login']) : false;
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : false;

if (!$login || !$senha) {
  echo "Digite a senha e login!";
  exit;
}

$sql = sprintf('SELECT * FROM USUARIO WHERE LOGIN = %s', $login);
$resultado = mysqli_query($link, $sql) or die("Erro!");
$total = mysqli_num_rows($resultado);

if ($total) {
  $dados = mysqli_fetch_array($resultado);
  if (!strcmp($senha, $dados["senha"])) {
    $_SESSION["codigo"] = $dados["codigo"];
    $_SESSION["login"] = stripslashes($dados["login"]);
    header("Location: index.php");
    exit;
  } else {
    echo "Senha inválida!";
    exit;
  }
} else {
  echo "O login fornecido por você é inexistente!";
  exit;
}
