<style>
a:hover{
    text-decoration:none;
}
.livre {
    background-color: rgba(205, 254, 218, 1);
}

.ocupado {
    background-color: rgba(255, 250, 193, 1);
}

.reservado {
    background-color: rgba(205, 205, 254, 1);
}

.bloqueado {
    background-color: rgba(254, 205, 205, 1)
}

a:hover{
    text-decoration:none;
}

#btnAdd,
#btnVoltar {
    margin-left: 15px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-th-large"></i> Gerencias Mesas
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
            <?php 
            $mesas = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,);
            foreach($mesas as $mesa){  
                $status = "livre";                
                $url = base_url("mesas/gerenciar/").$mesa;
                if(isset($mesas_indexadas[$mesa])){
                    $url = base_url("conta/gerenciar/").$mesas_indexadas[$mesa]->codigo;
                    switch ($mesas_indexadas[$mesa]->status){
                        case 2: $status = "ocupado";  break;
                        case 3: $status = "reservado";break;
                        case 4: $status = "bloqueado";break;
                    }
                }
            
            ?>
            <div class="col-md-3">
            <a href="<?= $url ?>" >
                <div class="card btn text-left prod <?= $status ?>">
                    <div class="card-body text-center" data-id="<?=$mesa?>">
                        <h6 class="card-title">Mesa <?= $mesa ?></h6>
                        <p class="card-text">Livre</p>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $(document).on('load', 'img', function() {
        console.log("aqui");
    });

});
</script>