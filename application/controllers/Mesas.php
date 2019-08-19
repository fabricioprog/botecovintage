<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mesas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
    }

    public function index()
    {
        $this->template->load('template', 'mesas');
    }
}