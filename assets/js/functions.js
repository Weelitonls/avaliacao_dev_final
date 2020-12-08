function Alerta(msg) {
  $('#alerta').html(msg);
}

function jRemoverProduto(iId) {

  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: 'remove_produto.php',
    data: {
      iId: iId
    },
    beforeSend: function () {
    }
  }).done(function (result) {
    window.location = 'produtos.php';
  });

}

/**
 * Função responsável por restaurar o produto
 *
 * @param {int} iId - Código do produto
 *
 * @return void
 */
function jRestauraProduto(iId) {
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: 'restaura_produto.php',
    data: {
      iId: iId
    },
    beforeSend: function () {
    }
  }).done(function (result) {
    window.location = 'produtos-excluidos.php';
  });

}

/**
 * Função responsável em calcular o Valor total da Venda por alteração de Quantidade
 *
 * @param {int} iQtde - Quantidade do Produto a ser vendido
 *
 * @return void
 */
function jCalcularTotal(iQtde) {
  if (parseInt(iQtde) > parseInt($('#qtde').attr('max'))){
    iQtde = $('#qtde').attr('max');
    $('#qtde').val(iQtde);
  }
  if ($('#produto_id').val() != '0') {
    var nValorUnitario = $('#ValorUnitario').val();
    var xValor = iQtde * nValorUnitario.replace(',','.');
    $('#valorTotal').val(xValor.toFixed(2).toString().replace('.',','));
  }
}

/**
 * Função responsável em calcular o Valor total da Venda por alteração do Valor Unitário
 *
 * @param {string} nValorUnitario - Valor unitário do Produto a ser vendido
 *
 * @return void
 */
function jCalcularTotalUnit(nValorUnitario) {
  if ($('#produto_id').val() != '0') {
    var iQtde = $('#qtde').val();
    var nValor = iQtde * nValorUnitario.replace(',','.');
    $('#valorTotal').val(nValor.toFixed(2).toString().replace('.',','));
  }

}

/**
 * Função responsável pela busca do valor do produto, desabilitar botão de compra e ajustar quantidade disponível para venda
 *
 * @param {int} iId - Código do Produto
 *
 * @return void
 */
function jPegarValor(iId) {
  if (iId == '0') {
    $('#ValorUnitario').val('');
    $('#qtde').val('');
    $('#valorTotal').val('');
    $('#btnComprar').prop('disabled', true);
  } else {
    $('#btnComprar').prop('disabled', false);
    $.ajax({
      method: 'POST',
      dataType: 'json',
      url: 'pega_valor.php',
      data: {
        iId: iId
      },
      beforeSend: function () { }
    }).done(function (result) {
      $('#ValorUnitario').val(result.nValor);
      $('#qtde').attr('max', result.iEstoque);
      $('#qtde').val(1);
      $('#valorTotal').val(result.nValor);
      jCalcularTotal(1);
    });
  }
}

/**
* Função responsável pelo cadastro e atualização do Produto
*
* @return void
*/
function jSalvaProduto() {
  if ($("input[name='sDescricao']").val() >= '0') {
    $.ajax({
      method: 'POST',
      url: 'salva_produto.php',
      dataType: 'json',
      data: $('#FormProduto').serialize(),
      beforeSend: function () {
      }
    }).done(function (result) {
      if (result.status == 1) {
        window.location = 'produtos.php';
      } else {
        $('#alerta').html(result.alerta);
      }
    });
  } else {
    $('#alerta').html('Há campos que devem ser preenchidos, favor verificar!');
  }
}

/**
* Função responsável pela venda do Produto e atualização do Valor Unitário
*
* @return void
*/
function jSalvaVenda() {
  var bAtualizaValor = 0;

  if ($('#atualizar_valor').is(':checked')) {
    bAtualizaValor = 1;
  }
  $.ajax({
    method: 'POST',
    url: 'salva_venda.php',
    dataType: 'json',
    data: {
      iProdutoId: $('#produto_id').val(),
      iQtde: $('#qtde').val(),
      nValorUnitario: $('#ValorUnitario').val(),
      nValorTotal: $('#valorTotal').val(),
      bAtualizaValor: bAtualizaValor
    },
    beforeSend: function () {
    }
  }).done(function (result) {
    if (result.status == 1) {
      window.location = 'form-venda.php';
    } else {
      $('#alerta').html(result.alerta);
    }
  });
}
