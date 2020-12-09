<?php
require_once('Conexao.php');
$oDb = new Conexao();
$link = $oDb->Conectar();
$Pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
session_start();

if(!isset($_SESSION['codigo']) || !isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
if ($Pesquisa != '') {
  $Sql = "
  SELECT P.IDPRODUTO
         , P.NOMEPRODUTO
         , F.NOMECOMPANHIA
         , C.NOMECATEGORIA
         , P.QUANTIDADEPORUNIDADE
         , P.PRECOUNITARIO
      FROM PRODUTOS P
      JOIN FORNECEDORES F
        ON F.IDFORNECEDOR = P.IDFORNECEDOR
      JOIN CATEGORIAS C
        ON C.IDCATEGORIA = P.IDCATEGORIA
     WHERE (NOMEPRODUTO LIKE '%$Pesquisa%'
        OR IDPRODUTO LIKE '$Pesquisa')
       AND DESCONTINUADO = 'F'";
} else {
  $Sql = "
    SELECT P.IDPRODUTO
         , P.NOMEPRODUTO
         , F.NOMECOMPANHIA
         , C.NOMECATEGORIA
         , P.QUANTIDADEPORUNIDADE
         , P.PRECOUNITARIO
      FROM PRODUTOS P
      JOIN FORNECEDORES F
        ON F.IDFORNECEDOR = P.IDFORNECEDOR
      JOIN CATEGORIAS C
        ON C.IDCATEGORIA = P.IDCATEGORIA
     WHERE DESCONTINUADO = 'F'
  ";
}
$Resultado = mysqli_query($link, $Sql);
?>


<!doctype html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="pt-br" />
  <link rel="icon" href="icone.png"/>
  <link rel="shortcut icon" type="image/x-icon" href="icone.png" />
  <title>NorthWind - Produtos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <link href="./assets/css/dashboard.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./assets/js/functions.js"></script>
</head>

<body class="">
  <div class="page">
    <div class="page-main">
      <div class="header py-4">
        <div class="container">
          <div class="d-flex">
            <a class="header-brand" href="./index.php">
              <img src="./logo.jpg" class="header-brand-img" alt="tabler logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
              <div>
                <span class="text-default">Bem vindo, <?=$_SESSION['nome']?></span>
                <a href="login.php?login=off" class="nav-link pr-0 leading-none">
                  <span class="text-danger">Sair</span>
                </a>
              </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
              <span class="header-toggler-icon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
              <form class="input-icon my-3 my-lg-0" action="./produtos.php">
                <input type="search" class="form-control header-search" name="pesquisa" placeholder="Search&hellip;" tabindex="1">
                <div class="input-icon-addon">
                  <i class="fe fe-search"></i>
                </div>
              </form>
            </div>
            <div class="col-lg order-lg-first">
              <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                </li>
                <li class="nav-item">
                  <a href="./produtos.php" class="nav-link active"><i class="fe fe-package"></i> Produtos</a>
                </li>
                <li class="nav-item">
                  <a href="./excluidos.php" class="nav-link"><i class="fe fe-trash"></i> Lixeira</a>
                </li>
                <li class="nav-item">
                  <a href="./categorias.php" class="nav-link"><i class="fe fe-package"></i> Categorias</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Produtos</h3>
                  <div class="card-options">
                    <div id="alerta" class="my-1 mr-2">
                    </div>
                    <a href="./form-produto.php" class="btn btn-outline-danger">Adicionar</a>
                  </div>
                </div>
                <?php if (!empty($Resultado)) { ?>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">#</th>
                          <th>Nome</th>
                          <th>Fornecedor</th>
                          <th>Categoria</th>
                          <th class="text-center">Quantidade x Unidade</th>
                          <th class="text-center">Preço Unitário</th>
                          <th class="w-1"></th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $Coluna = '
                          <tr>
                            <td><span class="text-muted">%s</span></td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td class="text-center">%s</td>
                            <td class="text-center">R$ %s</td>
                            <td>
                              <a class="icon" title="Alterar o Produto" href="./form-produto.php?produto=%s">
                                <i class="fe fe-edit"></i>
                              </a>
                            </td>
                            <td>
                              <a class="icon" title="Excluir Produto" href="javascript:void(0)" onclick="Remover(%s)">
                                <i class="fe fe-trash"></i>
                              </a>
                            </td>
                          </tr>
                        ';

                        while ($Registros = mysqli_fetch_array($Resultado, MYSQLI_ASSOC)) {
                          printf(
                            $Coluna,
                            $Registros['IDPRODUTO'],
                            $Registros['NOMEPRODUTO'],
                            $Registros['NOMECOMPANHIA'],
                            $Registros['NOMECATEGORIA'],
                            $Registros['QUANTIDADEPORUNIDADE'],
                            $Registros['PRECOUNITARIO'],
                            $Registros['IDPRODUTO'],
                            $Registros['IDPRODUTO']
                          );
                        }
                        ?>
                      </tbody>
                    </table>
                  <?php } else { ?>

                    <div style="text-align: center;">
                      <div class="bg-light p-3" style="max-height: 60px;border-radius: 6px; text-align: center;vertical-align: middle">
                        <h4 class="text-center">Nenhum Produto encontrado!</h4>
                      </div>
                    </div>
                  <?php } ?>

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>