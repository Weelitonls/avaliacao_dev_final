<?php
require_once('Conexao.php');
$oDb = new Conexao();
$link = $oDb->Conectar();

$ScriptAlerta = '
  <script>
    Alerta(%s);
  </script>
';
$sqlultimo = "SELECT IDPRODUTO FROM PRODUTOS ORDER BY IDPRODUTO DESC LIMIT 1";
$resultado = mysqli_query($link, $sqlultimo);
$Ultimo = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
$idproduto = $Ultimo['IDPRODUTO']+1;
$sql = 'INSERT INTO PRODUTOS(IDPRODUTO, NOMEPRODUTO, IDFORNECEDOR, IDCATEGORIA, QUANTIDADEPORUNIDADE, PRECOUNITARIO)VALUES(%s, "%s", %s, %s,"%s",%s)';

$sql = sprintf(
  $sql
  , $idproduto
  , $_POST['nome']
  , $_POST['fornecedor']
  , $_POST['categoria']
  , $_POST['quantidade']
  , number_format($_POST['preco'], 2,'.','')
);

if (mysqli_query($link, $sql)) {
  header("Location: produtos.php");
} else {
  header("Location: form-produto.php");
}
?>