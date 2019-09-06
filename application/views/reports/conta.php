<style>
@page {
    margin: 0px 0px 0px 5px !important;
    padding: 0px 0px 0px 5px !important;
    flex-wrap: wrap;
}

@font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: normal;
}

#content {
    width: 90%;
}

table {
    width: 250px;
}

.info_dinheiro {
    padding-left: 5px;
    text-align: right;
}

.produto {
    word-wrap: break-word;
}
</style>
<div id='content'>
    -------------<strong>BOTECO VINTAGE</strong>-----------
    <br>
    Endereço: Rua Padre Minguelino, 1159 - Fátima, Fortaleza - CE, CEP: 60040-300 <br>
    Telefone: (85) 996123082 (Rosal) <br>
    Início : <?= $conta->dia_semana . ' '. $conta->dt_inicio ?> <br>
    ---------------------------------------------------
    <table>
        <thead>
            <tr>
                <td width="5%">Qtd.</td>
                <td width="50%">Descrição</td>
                <td class="info_dinheiro" width="20%">Unit.</td>
                <td class="info_dinheiro" width="25%">Total</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pedidos as $pedido){ ?>
            <tr>
                <td><?= $pedido->quantidade ?> </td>
                <td class="produto"><?= substr($pedido->nm_produto,0,13); ?> </td>
                <td class="info_dinheiro"><?= str_replace('R$','', $pedido->lbl_valor_venda); ?></td>
                <td class="info_dinheiro"><?= str_replace('R$','', $pedido->lbl_total); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    --------------------------------------------------
    <table>
        <tbody>
            <tr>
                <td width="60%"> Conta </td>
                <td class="info_dinheiro" width="40%"><?= $total->lbl_soma ?></td>
            </tr>
            <tr>
                <td width="60%"> 10% </td>
                <td class="info_dinheiro" width="40%">
                    <?= $conta->fl_dez_porcento=='t'? $total->lbl_dez_porcento : 'R$ 00,00'; ?></td>
            </tr>
            <tr>
                <td width="60%"> <strong> Total </strong> </td>
                <td class="info_dinheiro" width="40%"> <strong>
                        <?= $conta->fl_dez_porcento=='t'? $total->total: $total->lbl_soma;  ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>