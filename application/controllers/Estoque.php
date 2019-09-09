<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Estoque extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();        
        $this->load->model('produto_model');
                
    }


    public function index()
    {
        $data['produtos'] = $this->produto_model->get_todos();
        $this->template->load('template', 'estoque');
    }

}