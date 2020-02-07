<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {
	public function get_user()
	{
		return $this->db->query("
			select * from user where akses <> 'admin'");
	}

	public function cek_email($email)
	{
		return$this->db->query("select * from user where email = '$email'");
	}

	public function insert_user($data)
	{
		return $this->db->insert('user', $data);
	}

	public function edit_user($id_user, $data)
	{
		$this->db->where('id_user', $id_user);
     	$this->db->update('user', $data); 
		return $this->db->affected_rows();
	}
}
