<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		
	}

	public function index()
	{
		$this->load->library('my_pdf');
		$this->load->view('pdf');
	}

	public function test()
	{
		echo realpath('../dc2/asset/document_files/Powerpoint2010.pdf');
	}














}

/* End of file Pdf.php */
/* Location: ./application/modules/Document/controllers/Pdf.php */


?>