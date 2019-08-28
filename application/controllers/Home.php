<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{	
		$this->template->load('template', 'home');
	}

	public function direciona(){
		send_alert("ola",4000,'danger');
		redirect(base_url(''));
	}


}
