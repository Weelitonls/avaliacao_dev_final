<?php

require_once('Conexao.php');
$oDb = new Conexao();
$rLink = $oDb->fConecta_mysql();

$sSql = '
  SELECT COUNT(*) AS TOTAL
   FROM PRODUTO
  WHERE EXCLUIDO = 0
  ';

$rResultado = mysqli_query($rLink, $sSql);
$iQtde_produtos = 0;

if ($rResultado) {
  $aRegistro = mysqli_fetch_array($rResultado, MYSQLI_ASSOC);
  $iQtde_produtos = $aRegistro['TOTAL'];
} else {
  echo 'Erro';
}

$sSql = ' SELECT COUNT(*) AS TOTAL FROM VENDA';

$rResultado = mysqli_query($rLink, $sSql);
$iQtde_vendas = 0;

if ($rResultado) {
  $aRegistro = mysqli_fetch_array($rResultado, MYSQLI_ASSOC);
  $iQtde_vendas = $aRegistro['TOTAL'];
} else {
  echo 'Erro';
}

?>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="pt-br" />
  <link rel="icon" href="icone.png"/>
  <link rel="shortcut icon" type="image/x-icon" href="icone.png" />
  <title>NorthWind</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <link href="./assets/css/dashboard.css" rel="stylesheet" />
  <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
</head>

<body class="">
  <div class="page">
    <div class="page-main">
      <div class="header py-4">
        <div class="container">
          <div class="d-flex">
            <a class="header-brand" href="./index.php">
              <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
              <div>
                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                  <span class="avatar" style="background-image: url(./demo/faces/male/30.jpg)"></span>
                  <span class="ml-2 d-none d-lg-block">
                    <span class="text-default">Weliton</span>
                    <small class="text-muted d-block mt-1">Administrator</small>
                  </span>
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
                  <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                </li>
                <li class="nav-item">
                  <a href="./produtos.php" class="nav-link"><i class="fe fe-package"></i> Produtos</a>
                </li>
                <li class="nav-item">
                  <a href="./form-venda.php" class="nav-link"><i class="fe fe-dollar-sign"></i> Venda</a>
                </li>
                <li class="nav-item">
                  <a href="./produtos-excluidos.php" class="nav-link"><i class="fe fe-trash"></i> Lixeira</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="page-header">
            <h1 class="page-title">
              Home
            </h1>
          </div>
          <div class="row row-cards">
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0"><?= $iQtde_produtos ?></div>
                  <?php if ($iQtde_produtos > 1) { ?>
                    <div class="text-muted mb-4">Produtos</div>
                  <?php } else { ?>
                    <div class="text-muted mb-4">Produto</div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0"><?= $iQtde_vendas ?></div>
                  <?php if ($iQtde_vendas > 1) { ?>
                    <div class="text-muted mb-4">Vendas</div>
                  <?php } else { ?>
                    <div class="text-muted mb-4">Venda</div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./assets/plugins/input-mask/js/jquery.mask.min.js"></script>
  <script src="./assets/js/functions.js"></script>
</body>

</html>