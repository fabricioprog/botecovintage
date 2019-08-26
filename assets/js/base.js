$modalTitulo = $("#myModal").find("#modalTitulo");



function anima_confirma() {
    $alert = $('#alert');
    $alert.finish()
    $alert.css('top', 0).css('opacity', 0);
    $alert.animate({ top: '40px', opacity: '1', }, 300)
        .delay(2000)
        .animate({ opacity: '0' }, 400);
}



function abrir_modal(titulo, conteudo) {
    $("MyModal").find("#modalCorpo").html("");
    $("#myModal").find("#modalTitulo").text(titulo);
    $("#modalCorpo").html(conteudo);
    $("#modalCorpo").find('form').removeAttr('hidden');
    $(conteudo).bootstrapMaterialDesign();
    $("#myModal").modal();
}