<?php

class Conexao
{

  private $host = 'localhost';
  private $usuario = 'root';
  private $senha = '';
  private $database = 'avaliacao';

  /**
   * Função responsável pela conexão com o banco de dados
   *
   * @return String $sCon - Resposta de conexão
   */
  public function fConecta_mysql()
  {

    $sCon = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
    mysqli_set_charset($sCon, 'utf8');
    if (mysqli_connect_errno()) {
      echo 'Erro ao tentar se conectar com o BD MySQL: ' . mysqli_connect_error();
    }
    return $sCon;
  }

  /**
   * Verifica se o SELECT está vazio
   *
   * @param int $sSql - SQL que será verificado
   *
   * @return boolean - resultado da verificação
   */
  public function fVazio($sSql)
  {
    if (mysqli_num_rows($sSql) > 0) {
      return false;
    } else {
      return true;
    }
  }
}
