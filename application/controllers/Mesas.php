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
        $this->load->model('mesa_model');  
        
    }

    public function index(){  
        $data = def_data_main_titulo('fa fa-th-large','Mesas');        
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

    public function mudar_mesa($cd_conta,$nova_mesa){        
        $is_mesa_status = $this->mesa_model->is_mesa_livre($nova_mesa);
        $is_conta_cupada = $this->conta_model->get_conta($cd_conta)->cd_status == self::OCUPADO;
        if($is_mesa_status===true && $is_conta_cupada){
            $this->conta_model->transferir_mesa($cd_conta,$nova_mesa);
            send_alert("Conta alterar para mesa $nova_mesa com Sucesso!!",4000,"success");
            redirect(base_url('mesas/'));
        }else{
            send_alert("Não foi possível transferir conta para mesa $nova_mesa, pois ela está $is_mesa_status->nm_status",4000,"warning");
            redirect(base_url('conta/gerenciar/'.$cd_conta));
        }
        
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