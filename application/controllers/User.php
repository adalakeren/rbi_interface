<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('M_user');
        if($this->session->userdata('logined') != true){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['dataUser'] = $this->M_user->get_user()->result();
        //var_dump($data['dataUpload']);die;
        $data['pageContent'] = 'user/list';

        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }       
    }

    public function add()
    {
        $data['pageContent'] = 'user/add';

        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }       
    }

    public function create()
    {
        //validasi email
        $cek_email = $this->M_user->cek_email($this->input->post('email'));
        //var_dump($cek_email->num_rows());die;

        if($cek_email->num_rows() < 1){
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'akses' => $this->input->post('akses'),
                'status' => 'aktif'
            ];

            $insert = $this->M_user->insert_user($data);

            if($insert){
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Tambah User Berhasil !!</div></div>");
            }else{
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Tambah User Gagal !!</div></div>");
            }
        }else{
            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal menambahkan User, Email telah digunakan !!</div></div>");
        }

        redirect('user', 'refresh');

    }

    public function edit($id_user)
    {
        $data['editdata'] = $this->db->get_where('user',array('id_user'=>$id_user))->result_object();
        $data['pageContent'] = 'user/edit';

        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }       
    }

    public function update()
  {  

    $id_user = $this->input->post('id_user');

    $data = array(
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'akses' => $this->input->post('akses'),
        'status' => 'aktif'       
    );

    $edit = $this->M_user->edit_user($id_user,$data);

    if($edit > 0){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Edit data berhasil !!</div></div>");
    }else{
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Edit User Gagal !!</div></div>");
    }  
     

     redirect('user','refresh');
    
}
    
}
