$modalTitulo = $("#myModal").find("#modalTitulo");

function abrir_modal(id,titulo, conteudo) {        
        $("#myModal").find("#modalTitulo").text(titulo);
        $("#modalCorpo").html(conteudo);
        $("#modalCorpo").find('form').removeAttr('hidden');
        $(conteudo).bootstrapMaterialDesign();
        $("#myModal").modal();
    }

    