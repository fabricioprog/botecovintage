<?php 
function trace($obj){
    return "<pre> ".print_r($obj)." </pre>";
}

function get_dinheiro($num,$rs=false){    
    $valor =  number_format($num, 2, ',', '.');
    $valor = $rs? 'R$ '.$valor:$valor;
    echo $valor;
}

function def_data_main_titulo($icone,$titulo){
	return array('main_titulo'=> array('icone'=> $icone,'titulo'=>$titulo));
}

if ( ! function_exists('alert')) {
	function alert()
	{
		$show_alert = get_instance()->session->flashdata('show_alert');
		//trace($show_alert); exit;
		get_instance()->session->unset_userdata('show_alert');
		if(isset($show_alert)) {
            //TODO: adaptar genérico do sistema
			echo '<div class="alert alert-' . $show_alert->type . ' alert-dismissible" role="alert" data-timer="'.$show_alert->timer.'">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong><i class="fa fa-'.$show_alert->icon.'"></i></strong> '.$show_alert->message.'
				</div>';
		}
	}
}


if ( ! function_exists('send_alert')) {
	function send_alert( $message , $timer = null , $type='danger' , $icon='exclamation-triangle'){
		$data = new stdClass();
		$data->type = $type ;
		$data->message = $message ;
		$data->icon = $icon;
		$data->timer = $timer ;
		get_instance()->session->set_flashdata('show_alert' , $data);
	}
}