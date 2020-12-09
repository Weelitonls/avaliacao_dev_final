<?php
require_once('Conexao.php');
$oDb = new Conexao();
$link = $oDb->Conectar();

$sql = sprintf("UPDATE PRODUTOS SET DESCONTINUADO = 'F' WHERE IDProduto = %s" , $_POST['IDProduto']);

if (mysqli_query($link, $sql)) {
  echo json_encode(['status' => 1]);
} else {
  echo json_encode(['status' => 0]);
}
