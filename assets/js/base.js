$modalTitulo = $("#myModal").find("#modalTitulo");


$(document).on('hidden.bs.modal' ,'#myModal' , function (e) {    
    $(this).off('click','#btn_confirmar');
    modal_set_confirmar('Salvar');    
  });



function anima_confirma(tp_alert, delay, msg) {
    $alert = $('#alert');
    $alert.find('.alert').removeClass().addClass('alert alert-' + tp_alert);
    $alert.find('#alert-msg').text(msg);
    $alert.find("#alert-msg").prepend('<i class="fa fa-check" aria-hidden="true"></i> ');
    $alert.css('display', 'none').finish();
    $alert.css('top', -100).css('opacity', 0).css('display', 'block');
    $alert.animate({ top: '10px', opacity: '1', }, 300)
        .delay(delay)
        .animate({ opacity: '0', top: -100 }, 1000)
        .animate({ top: -500 }, 1)

}

function modal_set_confirmar(texto){
    $("#myModal").find('#btn_confirmar').text(texto);
}

function abrir_modal(titulo, conteudo, atualiza_dom) {        
    $("#myModal").find("#modalTitulo").html(titulo);    
    $("#modalCorpo").html(conteudo);
    $("#modalCorpo").find('form').removeAttr('hidden');
    if(atualiza_dom){
        $(conteudo).bootstrapMaterialDesign();
    }
    $("#myModal").modal();
}