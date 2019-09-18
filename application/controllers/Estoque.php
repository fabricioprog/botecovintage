<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Estoque extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();        
        $this->load->model('produto_model');
        $this->load->model('categoria_model');
                
    }


    public function index()
    { 
        $data['grau_urgencia'] = array('Todos','Baixa Quantidade','Esgotado');
        $data['inputs'] = $this->input->get();
        if(!empty($inputs)){
            $data['sel_cateogira'] = $inputs['cd_categoria'];
            $data['urgencia'] = $inputs['urgencia'];
        }

        $cd_categoria = !empty($data['inputs']['cd_categoria']) ? $data['inputs']['cd_categoria'] : false;
        
        if( !empty($data['inputs']) && $data['inputs']['urgencia'] == '1'){
            $data['produtos'] = $this->produto_model->get_todos($cd_categoria,true);    
        }else if(!empty($data['inputs']) && $data['inputs']['urgencia'] == '2'){
            $data['produtos'] = $this->produto_model->get_todos($cd_categoria ,false,true);    
        }else{
            $data['produtos'] = $this->produto_model->get_todos($cd_categoria);
        }
        
        $data['categorias'] = $this->categoria_model->get_categorias();
        $this->template->load('template', 'estoque',$data);
    }

    public function update_estoque($ci_produto,$nr_estoque= null,$nr_limite=null ){
        if(empty($nr_estoque) && $nr_estoque!=0 ){
            $nr_estoque = null;
        }

        if(empty($nr_limite)&& $nr_estoque!=0){
            $nr_limite = null;
        }
        $this->produto_model->update_estoque($ci_produto,$nr_estoque,$nr_limite);
        send_alert('Estoque Alterado com Sucesso!!',1000,'success');
        echo json_encode(true);
        
    }

}