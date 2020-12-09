function Remover(IDProduto) {
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: 'excluir.php',
    data: {
      IDProduto: IDProduto
    },
    beforeSend: function () {
    }
  }).done(function (result) {
    if (result.status == 1) {
      sessionStorage.setItem('reload', 'true');
      sessionStorage.setItem('msg', '<div class="tag tag-success">Produto excluído com sucesso!<span class="tag-addon"><i class="fe fe-check"></i></span></div>');
      window.location.reload();
    } else {
      sessionStorage.setItem('reload', 'true');
      sessionStorage.setItem('msg', '<div class="tag tag-danger">Produto não foi excluído!<span class="tag-addon"><i class="fe fe-alert-triangle"></i></span></div>');
      window.location.reload();
    }
  });

}

function Restaurar(IDProduto) {
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: 'restaurar.php',
    data: {
      IDProduto: IDProduto
    },
    beforeSend: function () {
    }
  }).done(function (result) {
    if (result.status == 1) {
      sessionStorage.setItem('reload', 'true');
      sessionStorage.setItem('msg', '<div class="tag tag-success">Produto restaurado com sucesso!<span class="tag-addon"><i class="fe fe-check"></i></span></div>');
      window.location.reload();
    } else {
      sessionStorage.setItem('reload', 'true');
      sessionStorage.setItem('msg', '<div class="tag tag-danger">Produto não foi restaurado!<span class="tag-addon"><i class="fe fe-alert-triangle"></i></span></div>');
      window.location.reload();
    }
  });

}

window.onload = function() {
  var recarregou = sessionStorage.getItem('reload');
  var msg = sessionStorage.getItem('msg');
  if (recarregou) {
    sessionStorage.removeItem('reload');
    Alerta(msg);
  }
};

function Alerta(msg) {
  $('#alerta').html(msg);
  setTimeout(function () {
    $('#alerta').fadeOut(1500);
  }, 3000);
}
