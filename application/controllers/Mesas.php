<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mesas extends MY_Controller
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
        
    }

    public function index(){        
        $mesas_status = $this->conta_model->get_mesas_status();          
        $mesas_indexadas = array();
        foreach($mesas_status as $ms){            
            $mesas_indexadas[$ms->cd_mesa] = $ms;            
        }

        $data['mesas_indexadas']= $mesas_indexadas;
        $this->template->load('template', 'mesas',$data);
    }

    public function gerenciar($id){
        $data['mesa_id'] = $id;        
        $this->template->load('template', 'mesa',$data);
    }


    public function add_reserva($cd_mesa){        
        $date = new DateTime();        
        $this->conta_model->add_conta($cd_mesa, self::RESERVADO, $date->format('Y-m-d H:i:s'))->ci_conta;
        redirect(base_url('mesas'));
        //TODO: enviar alerta de mesa reservada
    }

    public function remover_reserva($cd_conta){
        if($this->conta_model->get_conta_aberta_by_mesa($cd_conta)->cd_status == self::RESERVADO){
            $conta = $this->pedido_model->get_pedidos($cd_conta,true);
            $this->conta_model->encerrar_conta($cd_conta,$conta->valor_total);
            //TODO: Criar uma confirmação para o usuário
            redirect(base_url('mesas'));
        }


    }


}