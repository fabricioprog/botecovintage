<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends MY_Controller {

	public function __construct() {	
		parent::__construct();
		$this->load->helper('url'); 		
		$this->load->model('categoria_model');
	}

	public function index()
	{		
		$categoria = $this->input->get('categoria');	
		if($categoria){			
			
			$this->template->load('template', 'produtos');
			
		}else{
			$data['categorias'] = $this->categoria_model->get_categorias();
			$this->template->load('template', 'categorias',$data);
		}
		
	}

	public function add_categoria(){
		 $c = (object)$this->input->post();
		 $imagem = $this->get_imagem_convertida($_FILES['imagem']);
		 $tp_imagem = $_FILES['imagem']['type'];		 
		 $this->categoria_model->add_categoria($c->categoria,$c->descricao,$tp_imagem,$imagem);
		
	}

	public function get_imagem_convertida($input_file=false){
		$input = $input_file?$input_file:$_FILES['imagem'];		
		$path = $input['tmp_name'];
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		if(!$input_file){			
			echo $base64;			
		}
		return $base64;
	}
}