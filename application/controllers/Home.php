<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');        
        $this->load->model('conta_model');
    }

    public function index()
    {
        $data = def_data_main_titulo('fa fa-line-chart','Página Inicial');    
        $ano_mes =  gmdate('Y-m', time());
        $data['consolidado'] = json_encode($this->conta_model->get_rendimentos_semanais($ano_mes));
        $data['consumo'] = json_encode($this->conta_model->get_relatorio_consumo($ano_mes));
        $this->template->load('template', 'home',$data);
    }

    public function direciona()
    {
        send_alert("ola", 4000, 'danger');
        redirect(base_url(''));
    }    

}