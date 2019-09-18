<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Cozinha extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');        
        $this->load->model('pedido_model');
    }

    public function index()
    {
        $data = def_data_main_titulo('fa fa-cutlery','Cozinha');
        $data['pedidos'] = json_encode($this->pedido_model->get_pedido_cozinha_livre());        
        $this->template->load('template', 'cozinha',$data);
    }
}