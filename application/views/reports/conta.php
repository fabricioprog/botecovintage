<style>
@page {
    margin: 0px 0px 0px 5px !important;
    padding: 0px 0px 0px 5px !important;
    flex-wrap: wrap;
}

body{
    font-size: 13px;
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
    ------------------<strong>BOTECO VINTAGE</strong>----------------
    <br>
    Endereço: Rua Padre Minguelino, 1159 - Fátima, Fortaleza - CE, CEP: 60040-300 <br>
    Telefone: (85) 996123082 (Rosal) <br>
    Conta: <?= $conta->ci_conta ?>  <br>
    Mesa: <?= $conta->cd_mesa ?>  <br>
    Início : <?= $conta->dia_semana . ' '. $conta->dt_inicio ?> <br>    
    --------------------------------------------------------------
    <table>
        <thead>
            <tr>
                <td width="5%">Qtd.</td>
                <td width="40%">Descrição</td>
                <td class="info_dinheiro" width="25%">Unit</td>
                <td class="info_dinheiro" width="35%">Total</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pedidos as $pedido){ ?>
            <tr>
                <td><?= $pedido->quantidade ?> </td>
                <td class="produto"><?= ucwords(strtolower(substr($pedido->nm_produto,0,20))); ?> </td>
                <td class="info_dinheiro"><?= 'R$ '.str_replace('$','', $pedido->lbl_valor_venda); ?></td>
                <td class="info_dinheiro"><?= 'R$ '.str_replace('$','', $pedido->lbl_total); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    -------------------------------------------------------------
    <table>
        <tbody>
            <tr>
                <td width="60%"> Conta </td>
                <td class="info_dinheiro" width="40%"><?= 'R$ '.str_replace('$','', $total->lbl_soma) ?></td>
            </tr>
            <tr>
                <td width="60%"> 10% </td>
                <td class="info_dinheiro" width="40%">
                    <?= 'R$ '.$conta->fl_dez_porcento=='t'? str_replace('$','', $total->lbl_dez_porcento) : 'R$ 0,00'; ?></td>
            </tr>
            <tr>
                <td width="60%"> <strong> Total </strong> </td>
                <td class="info_dinheiro" width="40%"> <strong>
                        <?= $conta->fl_dez_porcento=='t'? 'R$ '.str_replace('$','', $total->total): 'R$ '.str_replace('$','', $total->lbl_soma);  ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>