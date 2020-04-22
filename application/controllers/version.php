<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Version extends CI_Controller {

	private $db_fast;

    function __construct(){
        parent::__construct();
        
        $this->db_fast        = $this->load->database('db_fast', TRUE);

        if($this->session->userdata('logined') != true){
            redirect(base_url("login"));
        }
    }

    function check_version(){
    	$sql = "select `version` from user_access.t_application where application_id = 125";
        $query = $this->db_fast->query($sql);
        $result = $query->row();

        echo $result->version;
    }
}
