<style>
#btnAdd,
#btnVoltar {
    margin-left: 15px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-archive"></i> <?= $categoria->nm_categoria ?>
            <button id="btnAdd" type="button" class="btn btn-md btn-outline-success  btn-rounded pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </button>
            <a href="<?= base_url('produtos') ?>" id="btnVoltar"><span class="pull-right">
                    <button type="button" class="btn btn-md btn-outline-success pull-right">
                        <i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i></span>
                </button>
            </a>
        </p>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <?php foreach($produtos as $prod){  ?>
            <div class="col-md-4">
                <a href="#">
                    <div data-id="<?=$prod->ci_produto?>" class="card btn btn-primary text-left prod">
                        <img class="card-img-top img-fluid rounded mx-auto d-block" src="<?= $prod->img_produto ?>"
                            alt="Card image cap" style="padding:10px 10px 0px 10px">
                        <div class="card-body">
                            <h6 class="card-title"><?= $prod->nm_produto ?></h6>
                            <strong class="card-text valor_venda"><?= get_dinheiro($prod->valor_venda,true) ?></strong>
                            <p class="card-text"><?= $prod->ds_produto ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->load->view('modal/add_produto.php',array("id"=>'md_produto',"cd_categoria"=>$cd_categoria),true); ?>

<script>

function resizeImage(base64Str) {
    var img = new Image();
    img.src = base64Str;
    var canvas = document.createElement('canvas');
    var MAX_WIDTH = 100;
    var MAX_HEIGHT = 100;
    var width = img.width;
    var height = img.height;

    if (width > height) {
        if (width > MAX_WIDTH) {
            height *= MAX_WIDTH / width;
            width = MAX_WIDTH;
        }
    } else {
        if (height > MAX_HEIGHT) {
            width *= MAX_HEIGHT / height;
            height = MAX_HEIGHT;
        }
    }
    canvas.width = width;
    canvas.height = height;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(img, 0, 0, width, height);
    return canvas.toDataURL();
}



$(document).ready(function() {
    var add_prod = $('#md_produto').html();

    $(document).on('click', '#btnAdd', function(e) {
        $('form[name="md_produto"] input[name="id"]').val("").trigger('change');        
        abrir_modal("Adicionar Produto", add_prod);
        aplicar_js();
        return false;
    });

    $(document).on('click', '.prod', function() {
        $('form[name="md_produto"] input[name="id"]').val($(this).data('id')).trigger('change');
        abrir_modal("Editar Produto", add_prod);
        return false;
    });

    $("#myModal").on('change', 'input[type="file"]', function(e) {
        $form = $("#myModal").find('form')[0];
        var data = new FormData($form);
        $.ajax({
            type: "POST",
            url: "produtos/get_imagem_convertida",
            data: data,
            dataType: "text",
            processData: false,
            contentType: false,
            error: function(res) {
                console.log("erro");
            },
            success: function(data) {
                $("#myModal").find("#img").attr("src", data);
                $("#myModal").find("#preview_img").removeAttr('hidden');
            },
        });

    });

    $("#myModal").on('hide.bs.modal', function() {
        $("#myModal").find("#modalTitulo").text("");
        $("#modalCorpo").html("");
    });


    $("#myModal").on('click', '#btn_confirmar', function() {
        $form = $("#myModal").find('form')[0];
        let id = $($form).find('input[name="id"]').val();
        var url = "produtos/";
        if (id) {
            url += "update_produto"
        } else {
            url += "add_produto";
        }
        var data = new FormData($form);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "html",
            processData: false,
            contentType: false,
            error: function(res) {
                console.log(res);
            },
            success: function(data) {
                location.reload();
            },
        });
    });
});
</script>