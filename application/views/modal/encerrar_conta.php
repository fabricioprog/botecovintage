<div id="<?= $id ?>">
    <form name="<?= $id ?>" method="POST" action="<?=base_url('conta/encerrar_conta')?>" hidden>
        <input type="hidden" name="cd_conta" value="">
        <div class='row'>
            <div id='md-alert' class="alert alert-warning" role="alert" style='display:none'>
                <strong> Não foi possível finalizar o caixa: </strong>
                Valor Informado Menor que o esperado.
            </div>
            <div class='col-md-12'>
                <div class="form-group">
                    <label for="tp_pagamento" class="bmd-label-floating">Forma de pagamento</label>
                    <select class="form-control" name="tp_pagamento" id="tp_pagamento" required>
                        <option value=''></option>
                        <option value='1'>Cartão (Crédito)</option>
                        <option value='2'>Cartão (Débito)</option>                        
                        <option value='3'>Dinheiro</option>
                        <option value='4'>Pagamento Diversificado</option>
                    </select>
                </div>
            </div>
        </div>
        <div class='row' id='pn-pg-diversificado' style='display:none'>
            <div class='col-md-4'>
                <div class="form-group">
                    <label for="debito" class="bmd-label-floating">Valor Débito</label>
                    <input type="numeric" class="form-control" name="debito" disabled>
                </div>
            </div>
            <div class='col-md-4 pagamento-diversificado'>
                <div class="form-group">
                    <label for="credito" class="bmd-label-floating">Valor Crédito</label>
                    <input type="numeric" class="form-control" name="credito" disabled>
                </div>
            </div>
            <div class='col-md-4 pagamento-diversificado'>
                <div class="form-group">
                    <label for="dinheiro" class="bmd-label-floating">Valor Dinheiro</label>
                    <input type="numeric" class="form-control" name="dinheiro" disabled>
                </div>
            </div>
            <div class='col-md-12 pagamento-diversificado'>
                <table id="tbConta" class="row-border table-bordered hover table dt-responsive no-footer"
                    cellspacing="0" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Soma</th>
                            <th>Valor a Pagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-danger"> R$ <strong> <span id="md-lbl-soma" data-valor="0"> 0000 </span>
                                </strong> </td>
                            <td> <strong><span id="md-lbl-total"> 0000 </span> </strong> </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <button id="btn-confirmar-pagamento" type='submit' hidden>
        </div>
    </form>
</div>
<script>
$(document).find('input[name="cd_conta"]').val($("#cd_conta").val());

$(document).on('click', '#myModal #btn_confirmar', function() {
    let tp_pagamento = $(document).find('select[name="tp_pagamento"]').val();
    let conta_total = $(document).find('#conta_total').data('valor');
    if (tp_pagamento == '4' && calcula_valor() < conta_total) {
        $("#md-alert").css('display', 'none').finish();
        $("#md-alert").slideDown(400).delay(4000).slideUp(400);
        return false;
    }
    $("#btn-confirmar-pagamento").trigger('click');
    return false;
});

$(document).on('hidden.bs.modal', '#myModal', function(e) {
    $(document).off('click', '#btn_confirmar');
    $('#myModal').off('submit', 'form[name="<?= $id ?>"]');
    modal_set_confirmar('Salvar');
});


$(document).on('keyup', '#myModal input', function() {
    att_valor();
});

function calcula_valor() {
    let debito = converter_to_float($(document).find('input[name="debito"]').val());
    let credito = converter_to_float($(document).find('input[name="credito"]').val());
    let dinheiro = converter_to_float($(document).find('input[name="dinheiro"]').val());
    return parseFloat(debito + credito + dinheiro);
}

function att_valor() {
    let soma = calcula_valor();
    var conta_total = $('#conta_total').data('valor');
    $(document).find('#md-lbl-soma').attr('data-valor', soma);
    $td_soma = $(document).find('#md-lbl-soma').parents('td');
    $td_soma.removeClass();
    if (soma < conta_total) {
        $td_soma.addClass('text-danger');
    } else if (soma == conta_total) {
        $td_soma.addClass('text-success');
    } else {
        $td_soma.addClass('text-info');
    }
    soma = soma.toFixed(2).replace('.', ',');
    $(document).find('#md-lbl-soma').text(soma);

}

function converter_to_float(campo) {
    if (campo.length > 0) {
        return parseFloat(campo.replace('.', '').replace(',', '.'));
    } else {
        return 0;
    }
}

$(document).on('change', 'select[name="tp_pagamento"]', function() {
    $input_form = $("#myModal").find('#pn-pg-diversificado');
    if ($(this).val() == '4') {
        $input_form.fadeIn(400);
        $input_form.find('input').prop('disabled', false);
    } else {
        $input_form.fadeOut(400);
        $input_form.find('input').prop('disabled', true);
    }

});
</script>
</div>