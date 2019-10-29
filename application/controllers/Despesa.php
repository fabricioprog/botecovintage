<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Despesa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');        
        $this->load->model('categoria_model');
        $this->load->model('conta_model');        
        //$this->acesso_usuario_logado(array(self::ADMINISTRADOR,self::GERENTE));
    }

    public function index()
    {   
        
        $data = def_data_main_titulo('fa fa-money','Despesas');  
        $data = array_merge($data,def_data_btn('fa fa-share fa-plus','#','btn_add'));  
        $data['categorias'] = $this->categoria_model->get_categorias(true);  
        
        //$ano_mes =  gmdate('Y-m', time());
        
        $this->template->load('template', 'despesas',$data);
    }
    
    public function add_despesa($ajax = true){
        $despesa_input = $this->input->post();
        echo json_encode($despesa_input);

        

    }

}