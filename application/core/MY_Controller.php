<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    const ADMINISTRADOR = 1;
    const GERENTE = 2;
    const COZINHA = 3;
    const GARCOM = 4;


    public function __construct(){
        parent::__construct();
        $this->load->helper('log');        
    }

    public function converter_dinheiro_to_number($input){
        $input = str_replace(".","",$input);
        $input = str_replace(",",".",$input);
        return (float) $input;        
    }

    protected function acesso_usuario_logado($perfis = false){
        $usuario = $this->session->usuario;          
        if(empty((array)$usuario)){
            send_alert('Usuário não encontrado',5000,'danger');
            redirect(base_url('login'));
        }

        if(!$this->is_perfil_permissao($usuario,$perfis)){
            send_alert('Usuário sem permissão para acessar essa página',5000,'danger');
            redirect(base_url('login'));
        }
                
    }

    protected function converte_moeda_to_float($moeda){
        return str_replace(',','.', str_replace('.','',$moeda));
    }

    private function is_perfil_permissao($usuario,$perfis){        
        if($perfis){
            foreach($perfis as $perfil){
                if($usuario->cd_perfil == $perfil){
                    return true;
                }                
            }
            return false;
        }else{
            return true;
        }

    }
   



}