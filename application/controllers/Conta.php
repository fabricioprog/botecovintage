<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

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
        $this->load->model('pedido_model');
        $this->load->model('produto_model');
        $this->load->model('categoria_model');

    }

    public function index()
    {           
        $this->template->load('template', 'conta');
    }

    public function gerenciar($cd_conta)
    {   
        $conta_mesa_info = $this->conta_model->get_conta_aberta_by_mesa($cd_conta);
        $data = def_data_main_titulo('fa fa-th-large','Mesa '.$conta_mesa_info->cd_mesa);  
        $data = array_merge($data,def_data_btn('fa fa-share fa-flip-horizontal',base_url('mesas')));
        
        $data['conta_mesa_info'] = $conta_mesa_info;
        $data['mesa_id'] = $data['conta_mesa_info']->cd_mesa;
        if(!empty($data['conta_mesa_info']) && $data['conta_mesa_info']->cd_status == self::OCUPADO){                          
            $data['categorias'] = $this->categoria_model->get_categorias();
            $this->template->load('template', 'conta', $data);
        }elseif( !empty($data['conta_mesa_info']) && $data['conta_mesa_info']->cd_status == self::RESERVADO) {
            $data['ci_conta'] = $data['conta_mesa_info']->ci_conta;            
            $this->template->load('template', 'mesa',$data);            
        }else{
            $this->template->load('template', 'mesas');            
            //TODO: alerta de conta inválida
        }                
        
    }

    public function get_pedidos_conta($cd_conta,$ajax=true){
        $conta = new stdClass();
        //TODO: reparo emergiencial
        $cd_conta = str_replace('.','',str_replace(',','',$cd_conta));
        $conta->info =  $this->conta_model->get_conta($cd_conta);
        $conta->lista  = $this->pedido_model->get_pedidos($cd_conta);
        $conta->somatorio = $this->pedido_model->get_pedidos($cd_conta,true);
        if($ajax){
            echo json_encode($conta);
        }
        return $conta;
    }
    


    public function add_produto($ajax = true){
        $inputs =  $this->input->post();
        $p = $this->produto_model->get_produto($inputs['cd_produto']);
        $this->remover_estoque($p);
        
        $prod = $this->pedido_model->get_produto_conta($inputs['cd_conta'],$inputs['cd_produto']);
        
        if(empty($prod)){            
            $this->pedido_model->add_pedido($inputs['cd_conta'],$inputs['cd_produto']);
        }else{
            $prod->quantidade++;
            $this->pedido_model->update_pedido($prod->cd_conta,$prod->cd_produto,$prod->quantidade);
            
        }          
        $res = new StdClass();
        $res->pedidos = $this->get_pedidos_conta($inputs['cd_conta'],false);        
        $res->produtos = $this->produto_model->get_produtos_by_categoria($p->cd_categoria);
       if($ajax){
           echo json_encode($res);
       }     
        return $res;
    }

    private function remover_estoque($p){
        if(!empty($p->nr_limite) && $p->nr_estoque>0){            
            $p->nr_estoque--;
            $this->produto_model->update_estoque($p->ci_produto,$p->nr_estoque,$p->nr_limite);
        }
    }

    private function add_estoque($p){
        if(!empty($p->nr_limite)){            
            $p->nr_estoque++;
            $this->produto_model->update_estoque($p->ci_produto,$p->nr_estoque,$p->nr_limite);
        }
    }


    public function remover_produto_conta($produto,$cd_conta,$ajax=true){
        $ped = $this->pedido_model->get_conta_produto($cd_conta,$produto);
        $p = $this->produto_model->get_produto($produto);
        $this->add_estoque($p);

        
        if(!empty($ped)){            
            if($ped->quantidade>1){                                
                $this->pedido_model->update_pedido($ped->cd_conta,$ped->cd_produto,--$ped->quantidade);
            }else{                
                $this->pedido_model->remove_produto_conta($ped->cd_produto,$ped->cd_conta);
            }
            $res = new StdClass();
            $res->produtos = $this->produto_model->get_produtos_by_categoria($p->cd_categoria);
            $res->pedidos = $this->get_pedidos_conta($ped->cd_conta,false);
            if($ajax){
               echo json_encode($res);
            }
            return $res;
        }else{
            //TODO: Mensagem de alerta informando que conta e produto são inválidos
            return false;
        }


    }

    //Imprimir Boleto de pagamento
    public function fechar_conta(){}
    
    public function encerrar_conta(){        
        $inputs = $this->input->post();
        $conta = $this->get_pedidos_conta($inputs['cd_conta'],false);
        $pagamento_dp = $conta->somatorio->dez_porcento;
        if($conta->info->fl_dez_porcento=='f'){
            $pagamento_dp = 0;
        }

        $pagamento = array();
        $pagamento['credito'] = 0;
        $pagamento['debito'] = 0;        
        $pagamento['dinheiro'] = 0;

        switch($inputs['tp_pagamento']){
            case '1': $pagamento['credito'] = $conta->somatorio->soma+$pagamento_dp;  break;
            case '2': $pagamento['debito'] = $conta->somatorio->soma+$pagamento_dp; break;
            case '3': $pagamento['dinheiro'] = $conta->somatorio->soma+$pagamento_dp; break;
            case '4': 
            $pagamento['credito'] = !empty($inputs['credito'])? $this->converte_moeda_to_float($inputs['credito']):0;
            $pagamento['debito'] = !empty($inputs['debito'])? $this->converte_moeda_to_float($inputs['debito']):0;
            $pagamento['dinheiro'] = !empty($inputs['dinheiro'])? $this->converte_moeda_to_float($inputs['dinheiro']):0;
            break;
            default: //TODO: Mostrar erros de tipo de pagamento inválido
        }
         //TODO: Faer verificação backend se o que foi pago é meior ou igual ao o que foi cobrado.        
        $this->conta_model->encerrar_conta($conta->info->ci_conta,$pagamento_dp,$pagamento['credito'],$pagamento['debito'],$pagamento['dinheiro']);
        //TODO: Criar uma confirmação para o usuário
        redirect(base_url('mesas'));
    }
    

    

    public function recalcula_dez_porcento_conta($cd_conta,$fl_dez_porcento){                
        if($fl_dez_porcento == 'true'){            
            $this->conta_model->atualiza_status_dez_porcento(true,$cd_conta);
        }else{            
            $this->conta_model->atualiza_status_dez_porcento(false,$cd_conta);
        }
        $this->get_pedidos_conta($cd_conta);        
    }


    public function add_conta($id_mesa)
    {
        $date = new DateTime();        
        $conta = $this->conta_model->add_conta($id_mesa, self::OCUPADO, $date->format('Y-m-d H:i:s'))->ci_conta;                
        redirect(base_url('conta/gerenciar/').$conta);
    }
    public function ocupar_conta($cd_conta){
        if($this->conta_model->get_conta_aberta_by_mesa($cd_conta)->cd_status == self::RESERVADO){
            $date = new DateTime();        
            $this->conta_model->atualizar_status_conta($cd_conta,self::OCUPADO,$date->format('Y-m-d H:i:s'));            
            redirect(base_url('conta/gerenciar/').$cd_conta);
        }else{
            //TODO: Mostrar erro para usuário informando que a conta não está reservada para ser ocupada
        }
        
    }

    public function relatorio(){
        $inputs   = $this->input->post(); 
        $data = def_data_main_titulo('fa fa-file-o','Relatório'); 
         
        if(!empty($inputs)){
            $data['input_dt_inicio'] =  $inputs['dt_inicio'];           
            $data['input_dt_fim'] =  $inputs['dt_fim'];
            $dt_inicio = $this->convert_string_timestamp($inputs['dt_inicio']);
            $dt_fim = $this->convert_string_timestamp($inputs['dt_fim']);
            $data['relatorio_detalhado'] = $this->conta_model->get_contas_periodo($dt_inicio,$dt_fim);
            $data['relatorio_geral'] = $this->conta_model->get_faturamento_periodo($dt_inicio,$dt_fim);
            $data['cover'] = $this->conta_model->get_faturamento_cover($dt_inicio,$dt_fim)->valor;
        }                
        //TODO: Definir rotina para contabilizar todos os pedidos de acordo com intervalo
        $this->template->load('template', 'relatorio_contas',$data); 

    }
    
    private function converte_moeda_to_float($moeda){
        return str_replace(',','.', str_replace('.','',$moeda));
    }


    private function convert_string_timestamp($data){
        $dtime = DateTime::createFromFormat("d/m/Y H:i:s", $data);
        if(!$dtime){
            $dtime = DateTime::createFromFormat("d/m/Y H:i", $data);
        }
        return $dtime->format('Y-m-d H:i:s');;
    }

    public function report($cd_conta)
    {

        $data['conta'] = $this->conta_model->get_conta_aberta_by_mesa($cd_conta);
        $data['pedidos'] = $this->pedido_model->get_pedidos($cd_conta);
        $data['total'] = $this->pedido_model->get_pedidos($cd_conta,true);       

        
        $diasemana = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
        $data['conta']->dia_semana = $diasemana[ date('w',strtotime($data['conta']->dt_inicio))];        
		header("HTTP/1.1 200 OK");
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");	
		header("Cache-Control: private", false);
        header("Content-type: application/pdf");
        
        
        $dompdf = new DOMPDF();
        // instantiate and use the dompdf class
		$dompdf = new Dompdf();
		
		$conteudo =$this->load->view('reports/conta.php',$data,true);		
		$dompdf->loadHtml($conteudo);
		// (Optional) Setup the paper size and orientation
		$dompdf->set_paper(array(0,0,240,650));				
		// Render the HTML as PDF
        $dompdf->render();
		// Output the generated PDF to Browser
        $dompdf->stream('teste.pdf',array('Attachment'=>0));

    }

}