<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Cozinha extends MY_Controller
{

    public function index()
    {
        $this->template->load('template', 'cozinha');
    }
}