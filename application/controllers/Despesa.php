<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Despesa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');        
        $this->load->model('categoria_model');
        $this->load->model('despesa_model');        
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
    
    public function add_despesa(){
        $in = $this->input->post();
        $date = str_replace('/', '-', $in['dt_despesa'] );
        $in['dt_despesa'] = date("Y-m-d", strtotime($date));
        $in['valor'] = $this->converte_moeda_to_float($in['valor']);
        $this->despesa_model->add_despesa($in['cd_categoria'],$in['dt_despesa'],$in['ds_despesa'],$in['valor']);        
    }

}