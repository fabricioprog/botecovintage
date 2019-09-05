<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Home extends MY_Controller
{

    public function index()
    {
        $this->template->load('template', 'home');
    }

    public function direciona()
    {
        send_alert("ola", 4000, 'danger');
        redirect(base_url(''));
    }    

}