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


    public function add_reserva(){
        $inputs = $this->input->post(); 
        trace($inputs);
        $date = new DateTime();        
        $cd_conta = $this->conta_model->add_conta($inputs['cd_mesa'], self::RESERVADO, $date->format('Y-m-d H:i:s'))->ci_conta;   
        $this->reserva_mesa_model->add($inputs['nm_cliente'],$inputs['qtd_mesas'],$inputs['contato_1'],$inputs['contato_2'],$cd_conta);
        redirect(base_url('mesas'));


    }


}