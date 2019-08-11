<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends MY_Controller {

	public function index()
	{	
		$categoria = $this->input->get('categoria');
		if($categoria){
			$this->template->load('template', 'produtos');
		}else{
			$this->template->load('template', 'categorias');
		}

		
	}


}
