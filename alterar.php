<?php
require_once('Conexao.php');
$oDb = new Conexao();
$link = $oDb->Conectar();
session_start();

$sql = '
  UPDATE PRODUTOS
     SET NOMEPRODUTO = "%s"
       , IDFORNECEDOR = %s
       , IDCATEGORIA = %s
       , QUANTIDADEPORUNIDADE = "%s"
       , PRECOUNITARIO = %s
   WHERE IDPRODUTO = %s
';

$sql = sprintf(
  $sql
  , $_POST['nome']
  , $_POST['fornecedor']
  , $_POST['categoria']
  , $_POST['quantidade']
  , number_format($_POST['preco'], 2,'.','')
  , $_POST['id']
);

if (mysqli_query($link, $sql)) {
  header("Location: produtos.php");
} else {
  header(sprintf("Location: form-produto.php?produto=%s", $_POST['id']));
}
?>
