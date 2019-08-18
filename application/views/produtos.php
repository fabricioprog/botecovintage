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
            <button id="btnAdd" type="button" class="btn btn-md btn-outline-success pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </button>
            <a href="<?= base_url('produtos') ?>" id="btnVoltar"><span class="pull-right">
                    <button id="btnAdd" type="button" class="btn btn-md btn-outline-success pull-right">
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
                            <h5 class="card-title"><?= $prod->nm_produto ?></h5>
                            <strong class="card-text"><?= get_dinheiro($prod->valor_venda,true) ?></strong>
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
$(document).ready(function() {
    var add_cat = $('#md_produto');
    $(document).on('click', '#btnAdd', function(e) {
        abrir_modal('form', "Adicionar Nova Categoria", add_cat);
        return false;
    });

    $(".prod").click(function(){
        console.log($(this).data('id'));
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
            url: "produtos/add_produto",
            data: data,
            dataType: "html",
            processData: false,
            contentType: false,
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(data) {                  
                console.log(data);
                location.reload();
            },
        });
    });
});
</script>