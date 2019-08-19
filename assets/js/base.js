$modalTitulo = $("#myModal").find("#modalTitulo");

function abrir_modal(titulo, conteudo) {
        $("MyModal").find("#modalCorpo").html("");        
        $("#myModal").find("#modalTitulo").text(titulo);        
        $("#modalCorpo").html(conteudo);
        $("#modalCorpo").find('form').removeAttr('hidden');
        $(conteudo).bootstrapMaterialDesign();
        $("#myModal").modal();
    }  