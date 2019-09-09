<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="<?=base_url('')?>assets/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/template.css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/jquery.dataTables.min.css">


    <script src="<?=base_url('')?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url('')?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('')?>assets/js/jquery.datetimepicker.full.min.js"></script>
    <script src="<?=base_url('')?>assets/js/popper.min.js"></script>
    <script src="<?=base_url('')?>assets/js/bootstrap-material-design.min.js"></script>
    <script src="<?=base_url('')?>assets/js/jquery.mask.min.js"></script>
    <script>
    $(document).ready(function() {
        $('body').bootstrapMaterialDesign();
    });
    </script>
</head>

<body>
    <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer">    
        <header class="bmd-layout-header">
            <div class="navbar navbar-light bg-faded">
                <button id="btn-main-menu" class="navbar-toggler" type="button" data-toggle="drawer"
                    data-target="#dw-s1">
                    <span class="sr-only">Toggle drawer</span>
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="nav navbar-nav">
                    <li class="nav-item"> </li>
                </ul>
            </div>
        </header>
        <div id="dw-s1" class="bmd-layout-drawer bg-faded">
            <header>
                <a class="navbar-brand">
                    <?= $menu_header ?>
                </a>
            </header>
            <div class="list-group" id="main-menu">
                <?= $menu ?>
            </div>
        </div>
        <main class="bmd-layout-content">
            <div class="container main-content">
                <?= $contents; ?>
            </div>
        </main>
    </div>
    </div>
    <script src="<?=base_url('')?>assets/js/base.js"></script>
    <script src="<?=base_url('')?>assets/js/template.js"></script>
</body>

</html>
<div id="alert">
    <div class="alert alert-success" role="alert">
        <strong id="alert-msg"></strong>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalCorpo">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button id="btn_confirmar" type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>