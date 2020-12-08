<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="pt-br" />
  <link rel="icon" href="icone.png" />
  <link rel="shortcut icon" type="image/x-icon" href="icone.png" />
  <title>NorthWind</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <link href="./assets/css/dashboard.css" rel="stylesheet" />
</head>

<body>
  <div class="page">
    <div class="page-main">
      <div class="header py-4">
        <div class="container text-center">
          <a class="header-brand" href="./index.php">
            <img src="./logo.jpg" alt="tabler logo" style="width: 25%;">
          </a>
        </div>
      </div>
      <div class="my-6">
        <div class="container">
          <div class="row row-cards">
            <div class="offset-md-4 col-md-4">
              <form class="card" action="funcoes.php" method="post">
                <input type="hidden" name="acao" value="logar">
                <div class="card-header text-center font-weight-bold">
                  BEM VINDO AO NORTHWIND
                </div>
                <div class="card-body">
                  <span class="font-weight-bolder">Insira seu Login e senha para acessar a Plataforma!</span>
                  <div class="form-group my-4">
                    <label class="form-label">Login:</label>
                    <input type="text" class="form-control" name="login">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Senha:</label>
                    <input type="password" class="form-control" name="senha">
                  </div>
                  <span id="alerta" class="font-weight-bolder my-3 text-danger"></span>
                  <div class="text-center">
                    <input class="btn btn-outline-success" type="submit" value="Logar">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./assets/js/functions.js"></script>
</body>

</html>


<div class="container col-sm-4">

</div>