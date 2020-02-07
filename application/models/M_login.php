<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
	function cek_login($email,$password){
		$query=$this->db->query("SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1");
		return $query;
	}
}