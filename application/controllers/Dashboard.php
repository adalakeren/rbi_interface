<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('logined') != true){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['pageContent'] = 'dashboard';

		if($this->session->userdata('akses') == 'admin'){
			$this->load->view('layout_admin', $data);
		}else{
			$this->load->view('layout', $data);
		}      	
	}
}
