<style>
a:hover {
    text-decoration: none;
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

a:hover {
    text-decoration: none;
}

#btnAdd,
#btnVoltar {
    margin-left: 15px;
}
</style>
<?php alert() ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <?php 
            $mesas = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
            foreach($mesas as $mesa){  
                $status = "livre";                
                $url = base_url("mesas/gerenciar/").$mesa;
                $lbl_mesa = "Livre";
                if(isset($mesas_indexadas[$mesa])){
                    $url = base_url("conta/gerenciar/").$mesas_indexadas[$mesa]->codigo;
                    switch ($mesas_indexadas[$mesa]->status){
                        case 2: $status = "ocupado"; $lbl_mesa = "Ocupada";  break;
                        case 3: $status = "reservado"; $lbl_mesa = "Reservada"; ;break;
                        case 4: $status = "bloqueado"; $lbl_mesa = "Bloqueada"; ;break;
                    }
                }
            
            ?>
            <div class="col-md-3">
                <a href="<?= $url ?>">
                    <div class="card btn text-left prod <?= $status ?>">
                        <div class="card-body text-center" data-id="<?=$mesa?>">
                            <h6 class="card-title">Mesa <?= $mesa ?></h6>
                            <p class="card-text"><?=$lbl_mesa?></p>
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