<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('log');        
    }

    public function converter_dinheiro_to_number($input){
        $input = str_replace(".","",$input);
        $input = str_replace(",",".",$input);
        return (float) $input;        
    }

    public function addJS(){}

    public function addCSS(){}
        
   



}