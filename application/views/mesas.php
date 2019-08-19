<style>
.livre{
    background-color:rgba(205,254,218,1);
}
.ocupado{
    background-color:rgba(255,250,193,1);
}
.reservado{
    background-color:rgba(205,205,254,1);
}
.bloqueado{
    background-color:rgba(254,205,205,1)
}

#btnAdd,
#btnVoltar {
    margin-left: 15px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
        <i class="fas fa-th-large"></i> Teste
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
            <?php $mesas = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
            foreach($mesas as $mesa){  ?>
            <div class="col-md-3">
                    <div data-id="" class="card btn text-left prod ocupado">
                        <div class="card-body text-center">
                            <h6 class="card-title">M</h6>                            
                            <p class="card-text">cons</p>
                            <p class="card-text">label</p>
                        </div>
                    </div>
                
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {});
</script>