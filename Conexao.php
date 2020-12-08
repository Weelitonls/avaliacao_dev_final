<?php

class Conexao
{

  private $host = 'localhost';
  private $usuario = 'root';
  private $senha = '';
  private $database = 'northwind';

  public function Conectar() {

    $sCon = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
    mysqli_set_charset($sCon, 'utf8');
    if (mysqli_connect_errno()) {
      echo 'Erro ao tentar se conectar com o BD MySQL: ' . mysqli_connect_error();
    }
    return $sCon;
  }

  public function Vazio($sSql) {
    if (mysqli_num_rows($sSql) > 0) {
      return false;
    } else {
      return true;
    }
  }
}
