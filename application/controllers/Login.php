<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');        
        
    }

    public function index()
    {   
        $inputs = $this->input->post();
        if(empty($inputs)){
            $this->load->view('login');
        }else{
            $this->autenticacao($inputs);
        }     
        
    }

    private function autenticacao(){

        send_alert('Ola', 3000,'warning');
        $this->load->view('login');

    }

}