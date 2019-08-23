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

    }

    public function index()
    {
        $this->template->load('template', 'conta');
    }

    public function mesa($id)
    {
        $data['mesa_id'] = $id;
        $this->template->load('template', 'conta', $data);
    }

    

    public function add_conta($id_mesa)
    {
        $date = new DateTime();        
        $this->conta_model->add_conta($id_mesa, self::OCUPADO, $date->format('Y-m-d H:i:s'));
        //TODO: Redirecionar para página de mesas ocupada com Categorias e produtos
        redirect(base_url('mesas'));
    }

}
