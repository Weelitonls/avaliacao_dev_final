<?php
require_once('Conexao.php');
$oDb = new Conexao();
$link = $oDb->Conectar();


switch(isset($_REQUEST['acao'])) {
  case 'logar':
    Logar($link);
    break;
}

function Logar($link) {
  echo "entrou aqui";
  $ScriptAlerta = '
    <script>
      Alerta(%s);
    </script>
  ';

  $login = isset($_POST['login']) ? trim($_POST['login']) : false;
  $senha = isset($_POST['senha']) ? trim($_POST['senha']) : false;

  if (!$login || !$senha) {
    echo "Digite a senha e login!";
    exit;
  }

  $sql = sprintf("SELECT * FROM USUARIO WHERE LOGIN = '%s'", $login);
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
      header("Location: login.php");
      printf(
        $ScriptAlerta
        , 'Senha Inválida!'
      );
      exit;
    }
  } else {
    header("Location: login.php");
      printf(
        $ScriptAlerta
        , 'O login fornecido por você é inexistente!'
      );
    exit;
  }
}