<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_login');
	}

	function index(){
        $this->load->view('login');
    }
 
    function aksi_login(){
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean(md5($this->input->post('password')));

        $cek_login = $this->M_login->cek_login($email,$password);

        if($cek_login->num_rows() > 0){
            $data=$cek_login->row_array();
 
            $data_session = array(
                'id_user' => $data['id_user'],
                'email' => $data['email'],
                'akses' => $data['akses'],
                'logined' => true
            );
 
            $this->session->set_userdata($data_session);
 
            redirect(base_url("dashboard"));
 
        }else{
            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Username / Password Salah !!</div></div>");
            redirect('login','refresh');
        }
    }

	function logout(){
        session_destroy();
        $this->session->unset_userdata('logined');
        redirect("login");
    }
}
