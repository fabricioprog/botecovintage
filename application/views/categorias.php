<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-archive"></i> Gerenciar Produtos
            <button id="btnAdd" type="button" class="btn btn-md btn-outline-success pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </p>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <?php foreach($categorias as $cat){  ?>
            <div class="col-md-4">
                <a href="<?= base_url("produtos?categoria=".$cat->ci_categoria) ?>">
                    <div class="card btn btn-primary text-left">
                        <img class="card-img-top img-fluid rounded mx-auto d-block" src="<?= $cat->imagem ?>"
                            alt="Card image cap" style="padding:10px 10px 0px 10px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $cat->nm_categoria ?></h5>
                            <p class="card-text"><?= $cat->ds_categoria ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->load->view('modal/add_categoria.php',array("id"=>'md_categoria'),true); ?>
<script>
$(document).ready(function() {
    var add_cat = $('#md_categoria');
    $(document).on('click', '#btnAdd', function(e) {
        abrir_modal('form1', "Adicionar Nova Categoria", add_cat);
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
                console.log(res);
            },
            success: function(data) {
                $("#img").attr("src", data);
                $("#myModal").find("#preview_img").removeAttr('hidden');
            },
        });

    })


    $("#myModal").on('click', '#btn_confirmar', function() {
        $form = $("#myModal").find('form')[0];
        var data = new FormData($form);
        $.ajax({
            type: "POST",
            url: "produtos/add_categoria",
            data: data,
            dataType: "html",
            processData: false,
            contentType: false,
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(data) {
                location.reload()
            },
        });
    });
});
</script>