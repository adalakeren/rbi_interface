<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_upload extends CI_Model {
	public function get_upload()
	{
		return $this->db->query("
			select up.*, u.nama, count(dn) as dn_count from upload up
			join detail_upload d ON up.id_upload = d.id_upload
			join user u ON d.id_user = u.id_user
			group by d.id_upload");
	}

	public function get_upload_ship_party()
	{
		return $this->db->query("
			select up.*, u.nama from upload_ship up
			join ship_to_party d ON up.id_upload = d.id_upload
			join user u ON d.user_created = u.id_user
			group by d.id_upload");
	}

	// Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert('detail_upload', $data);
	}

	public function update_multiple($data, $id){
		$this->db->update('detail_upload', $data, array('dn' => $id));
	}

	public function insert_ship_to_party($data){
		$this->db->insert('ship_to_party', $data);
	}

	public function update_ship_to_party($data, $id){
		$this->db->update('ship_to_party', $data, array('ship_to_party' => $id));
	}

	public function getDetailUpload($id_upload){
		return $this->db->query("select du.* from upload u join detail_upload du on u.id_upload = du.id_upload where u.id_upload = '$id_upload'");
	}

	public function getDetailUploadShip($id_upload){
		return $this->db->query("select u.* from ship_to_party u join upload_ship du on u.id_upload = du.id_upload where u.id_upload = '$id_upload'");
	}

	public function getDataUpload($no_dn){
		$query = $this->db->query("SELECT * FROM detail_upload WHERE dn = '$no_dn'");
		return $query->row();
	}

	public function getDataUploadShip($no_dn){
		$query = $this->db->query("SELECT ship_to_party FROM ship_to_party WHERE ship_to_party = '$no_dn'");
		return $query->row();
	}
}
