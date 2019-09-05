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

    public function report()
    {	
		header("HTTP/1.1 200 OK");
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	
		header("Cache-Control: private", false);
	
		header("Content-type: application/pdf");

        $dompdf = new DOMPDF();
        // instantiate and use the dompdf class
		$dompdf = new Dompdf();
		
		$conteudo =$this->load->view('reports/conta.php','',true);
		//$dompdf->loadHtml('123456789-123456789-123456789-123456789-teste');
		$dompdf->loadHtml($conteudo);
		// (Optional) Setup the paper size and orientation
		$dompdf->set_paper(array(0,0,240,650));		
		//$dompdf->set_paper('A4','portrait');
		// Render the HTML as PDF
        $dompdf->render();
		// Output the generated PDF to Browser
        $dompdf->stream('teste.pdf',array('Attachment'=>0));

    }

}