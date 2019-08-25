<?php 
function trace($obj){
    echo "<pre> ".print_r($obj)." </pre>";
}

function get_dinheiro($num,$rs=false){    
    $valor =  number_format($num, 2, ',', '.');
    $valor = $rs? 'R$ '.$valor:$valor;
    echo $valor;
}