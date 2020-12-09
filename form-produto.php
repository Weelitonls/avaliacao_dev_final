<?php
require_once('Conexao.php');
$oDb = new Conexao();
$link = $oDb->Conectar();
session_start();

if(!isset($_SESSION['codigo']) || !isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
$IDProduto = isset($_GET['produto']) ? $_GET['produto'] : 0;
$Produto = [];
if ($IDProduto > 0) {
  $sql = sprintf('SELECT * FROM PRODUTOS WHERE IDPRODUTO = %s LIMIT 1', $IDProduto);
  $Resultado = mysqli_query($link, $sql);
  $Produto = mysqli_fetch_array($Resultado, MYSQLI_ASSOC);
}

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
  <title>NorthWind - Novo Produto</title>
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
          <div class="row">
            <div class="col-lg-12">
              <form class="card" action="<?=!empty($Produto['IDProduto']) ? 'alterar.php' : 'salvar.php' ?>" method="post">
                <div class="card-body">
                  <h3 class="card-title"><?=!empty($Produto['IDProduto']) ? 'Alterar Produto' : 'Novo Produto' ?></h3>
                  <input type="hidden" name="id" value="<?=!empty($Produto['IDProduto']) ? $Produto['IDProduto'] : '' ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" required name="nome" autocomplete="off" value="<?=!empty($Produto['NomeProduto']) ? $Produto['NomeProduto'] : '' ?>" placeholder="Arroz..">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Quantidade por Unidade</label>
                        <input type="text" class="form-control" name="quantidade" value="<?=!empty($Produto['QuantidadePorUnidade']) ? $Produto['QuantidadePorUnidade'] : '' ?>" autocomplete="off" placeholder="10 Uni p/CX">
                      </div>
                    </div>
                    <?php
                      $Campos = '
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Fornecedor</label>
                            %s
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Categoria</label>
                            %s
                          </div>
                        </div>
                      ';

                      $select = '
                        <select class="form-control" name="%s" required>
                          %s
                        </select>
                      ';

                      $option = '<option value="%s" %s>%s</option>';

                      $sqlF = '
                          SELECT IDFORNECEDOR
                                , NOMECOMPANHIA
                            FROM FORNECEDORES
                        ORDER BY NOMECOMPANHIA
                      ';

                      $sqlC = '
                          SELECT IDCATEGORIA
                                , NOMECATEGORIA
                            FROM CATEGORIAS
                        ORDER BY NOMECATEGORIA
                      ';

                      $ResultadoF = mysqli_query($link, $sqlF);
                      $ResultadoC = mysqli_query($link, $sqlC);
                      $optionsF = [];
                      $optionsC = [];
                      if (!empty($ResultadoF)) {
                        while ($Fs = mysqli_fetch_array($ResultadoF, MYSQLI_ASSOC)) {
                          if (!empty($Produto['IDFornecedor']) && $Produto['IDFornecedor'] == $Fs['IDFORNECEDOR']) {
                            $optionsF[] = sprintf($option, $Fs['IDFORNECEDOR'], 'selected="selected"', $Fs['NOMECOMPANHIA']);
                          } else {
                            $optionsF[] = sprintf($option, $Fs['IDFORNECEDOR'], '', $Fs['NOMECOMPANHIA']);
                          }
                        }
                      }

                      if (!empty($ResultadoC)) {
                        while ($Cs = mysqli_fetch_array($ResultadoC, MYSQLI_ASSOC)) {
                          if (!empty($Produto['IDCategoria']) && $Produto['IDCategoria'] == $Cs['IDCATEGORIA']) {
                            $optionsC[] = sprintf($option, $Cs['IDCATEGORIA'], 'selected="selected"', $Cs['NOMECATEGORIA']);
                          } else {
                            $optionsC[] = sprintf($option, $Cs['IDCATEGORIA'], '', $Cs['NOMECATEGORIA']);
                          }
                        }
                      }

                      $selectF = sprintf(
                        $select
                        , 'fornecedor'
                        , implode(' ', $optionsF)
                      );

                      $selectC = sprintf(
                        $select
                        , 'categoria'
                        , implode(' ', $optionsC)
                      );

                      printf(
                        $Campos
                        , $selectF
                        , $selectC
                      );


                    ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Preço unitário</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                          </span>
                          <input type="number" class="form-control text-right" required autocomplete="off" value="<?=!empty($Produto['PrecoUnitario']) ? $Produto['PrecoUnitario'] : '' ?>" name="preco"><br>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-left" style="display: flex; justify-content: space-between">
                  <div>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar para produtos</a>
                  </div>
                  <div>
                    <span id="alerta"></span>
                    <input class="btn btn-outline-success" type="submit" value="Confirmar">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>