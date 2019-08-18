<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends MY_Controller {

	public function __construct() {	
		parent::__construct();
		$this->load->helper('url'); 		
		$this->load->model('categoria_model');
		$this->load->model('produto_model');
	}

	public function index()
	{		
		$ci_categoria = $this->input->get('categoria');	
		if($ci_categoria){		
			$data['categoria'] = $this->categoria_model->get_categoria($ci_categoria);
			$data['produtos'] = $this->produto_model->get_produtos_by_categoria($ci_categoria);
			$data['cd_categoria'] = $ci_categoria;			
			$this->template->load('template', 'produtos',$data);
			
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

	public function add_produto(){
		$p= (object)$this->input->post();		
		$imagem = $this->get_imagem_convertida($_FILES['imagem']);				
		$tp_imagem = $_FILES['imagem']['type'];		
		$p->valor_venda = $this->converter_dinheiro_to_number($p->valor_venda);				
		$this->produto_model->add_produto($p->produto,$p->descricao,0,$imagem,$tp_imagem,$p->categoria,$p->valor_venda);
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