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
        $in = $this->input->post();
        $data = def_data_main_titulo('fa fa-money','Despesas');  
        $data = array_merge($data,def_data_btn('fa fa-share fa-plus','#','btn_add'));  
        $data['categorias'] = $this->categoria_model->get_categorias(true);  

        if(!empty($in)){
            $inputs = array();
            $inputs['dt_inicio'] = $in['dt_inicio'];
            $inputs['cd_categoria'] = $in['cd_categoria'];            
            $data['inputs'] =$inputs;

            $in['dt_inicio'] = $this->format_date($in['dt_inicio'],'Y-m-d H:i:s');            
            $in['dt_fim'] = $this->format_date($in['dt_fim'],'Y-m-d H:i:s');
            $data['relatorio_detalhado'] = $this->despesa_model->get_despesas($in['dt_inicio'],$in['dt_fim'],$in['cd_categoria']);            
            
        }
        
        $this->template->load('template', 'despesas',$data);
    }

    public function remover_despesa($id){
        $this->despesa_model->remover_despesa($id);
    }
    
    public function add_despesa(){
        $in = $this->input->post();        
        $in['dt_despesa'] = $this->format_date($in['dt_despesa'],'Y-m-d H:i:s');
        $in['valor'] = $this->converte_moeda_to_float($in['valor']);
        $this->despesa_model->add_despesa($in['cd_categoria'],$in['dt_despesa'],$in['ds_despesa'],$in['valor']);        
    }

}