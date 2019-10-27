<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->model('usuario_model');    
        
    }

    public function index()
    {   
        $inputs = $this->input->post();
        if(empty($inputs)){
            $this->load->view('login');
        }else{
            $this->autenticacao($inputs['usuario'],$inputs['senha']);
        }
    }

    private function autenticacao($usuario,$senha){        
        $usuario = $this->usuario_model->get_usuario_senha($usuario,$senha);
        
        if(empty($usuario)){
            send_alert('Usuário e Senha não conferem, contacte o Adminstrador do Sistema',5000,'danger');
            redirect(base_url('login'));
        }else{
            $this->session->usuario = $usuario;
            $this->redirect_usuario($usuario);
        }
    }

    private function redirect_usuario($usuario){        
        if($usuario->cd_perfil == self::ADMINISTRADOR || $usuario->cd_perfil == self::GERENTE){
            redirect(base_url('home'));
        }elseif($usuario->cd_perfil == self::COZINHA){
            redirect(base_url('cozinha'));
        }elseif($usuario->cd_perfil == self::GARCOM){
            redirect(base_url('mesas'));
        }else{            
            redirect(base_url('home'));
        }

    }

    public function logout(){
        $this->session->unset_userdata('usuario');        
        redirect(base_url('login'));
    }

}