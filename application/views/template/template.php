<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('template/imports_head') ?>

<body>
    <div id="main-menu" class="bmd-layout-container bmd-drawer-f-l bmd-drawer">
        <header class="bmd-layout-header">
            <div class="navbar navbar-light bg-faded">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <button id="btn-main-menu" class="navbar-toggler" type="button" data-toggle="drawer"
                                data-target="#dw-s1">
                                <span class="sr-only">Toggle drawer</span>
                                <i class="fa fa-bars"></i>
                            </button>
                            <?php if(isset($main_titulo)) { ?>
                            <span class="h4  text-primary main-titulo">
                                <i class="<?= $main_titulo['icone'] ?>"></i>
                                <?= $main_titulo['titulo'] ?>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <?php if(isset($btn_aux)) { ?>
                                    <a href="<?= $btn_aux['link'] ?>">
                                        <span class="pull-right">
                                            <button type="button" <?= $btn_aux['id'] ? "id='".$btn_aux['id']."'":""; ?>  class="btn btn-md btn-outline-success pull-right">
                                                <i class="<?= $btn_aux['icone'] ?>" aria-hidden="true"></i></span>
                                        </button>
                                    </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                <h5 class="modal-title" id="modalTitulo"></h5>
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