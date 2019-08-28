<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conta extends MY_Controller
{

    const LIVRE = 1;
    const OCUPADO = 2;
    const RESERVADO = 3;
    const BLOQUEAD = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('conta_model');
        $this->load->model('pedido_model');
        $this->load->model('categoria_model');

    }

    public function index()
    {           
        $this->template->load('template', 'conta');
    }

    public function gerenciar($cd_conta)
    {   
        $data['conta_mesa_info'] = $this->conta_model->get_conta_aberta_by_mesa($cd_conta);
        $data['mesa_id'] = $data['conta_mesa_info']->cd_mesa;
        $data['categorias'] = $this->categoria_model->get_categorias();                
        $this->template->load('template', 'conta', $data);
    }

    public function get_pedidos_conta($cd_conta,$ajax=true){
        $conta = new stdClass();
        $conta->lista  = $this->pedido_model->get_pedidos($cd_conta);
        $conta->somatorio = $this->pedido_model->get_pedidos($cd_conta,true);
        if($ajax){
            echo json_encode($conta);
        }
        return $conta;
    }
    


    public function add_produto($ajax = true){
        $inputs =  $this->input->post();
        
        $prod = $this->pedido_model->get_produto_conta($inputs['cd_conta'],$inputs['cd_produto']);
        
        if(empty($prod)){            
            $this->pedido_model->add_pedido($inputs['cd_conta'],$inputs['cd_produto']);
        }else{
            $prod->quantidade++;
            $this->pedido_model->update_pedido($prod->cd_conta,$prod->cd_produto,$prod->quantidade);
            
        }
        $res = $this->get_pedidos_conta($inputs['cd_conta'],false);
       if($ajax){
           echo json_encode($res);
       }     
        return $res;
    }

    public function fechar_conta(){}
    
    public function encerrar_conta(){}

    public function remover_conta(){}        

    public function add_conta($id_mesa)
    {
        $date = new DateTime();        
        $conta = $this->conta_model->add_conta($id_mesa, self::OCUPADO, $date->format('Y-m-d H:i:s'))->ci_conta;                
        redirect(base_url('conta/gerenciar/').$conta);
    }

}