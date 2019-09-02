<div id="<?= $id ?>">
    <form name="<?= $id ?>" method="POST" hidden enctype="multipart/form-data" >
        <div class="form-group">
            <label for="tp_pagamento" class="bmd-label-floating">Forma de pagamento</label>
            <select class="form-control" name="tp_pagamento" id="tp_pagamento" required>
                <option value=''></option>
                <option value='1'>Cartão</option>
                <option value='2'>Dinheiro</option>
                <option value='3'>Dinheiro e Cartão</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cartao" class="bmd-label-floating">Valor Parcial em Carao</label>
            <input type="numeric" class="form-control" name="cartao" required>
            <span class="bmd-help">O resto entrará no caixa como dinheiro</span>
        </div>
        <button id="btn-confirmar-pagamento" type='submit' name='btn-confirmar-pagamento' hidden>
    </form>
    <script>
    $('#myModal').on('click', '#btn_confirmar', function() {
        console.log("evento botão");
        let cd_conta = $(document).find("#cd_conta").val();        
        $("#btn-confirmar-pagamento").trigger('click');
        return false;
    });

      $('#myModal').on('submit','form[name="<?= $id ?>"]',function(){
          console.log("Redireciona");
          //window.location = "<?= base_url ('conta/encerrar_conta/')?>" + cd_conta;
          return false;
      });

    $(document).on('hidden.bs.modal', '#myModal', function(e) {
        $(document).off('click', '#btn_confirmar');
        $('#myModal').off('submit', 'form[name="<?= $id ?>"]');
        modal_set_confirmar('Salvar');
    });


    $("#myModal").find('input[name="cartao"]').mask('000.000,00', {
        reverse: true
    });
    $("#myModal").on('change', 'select[name="tp_pagamento"]', function() {
        console.log($(this).val());
    });
    </script>
</div>