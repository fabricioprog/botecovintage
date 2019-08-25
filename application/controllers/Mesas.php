<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mesas extends MY_Controller
{
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


}