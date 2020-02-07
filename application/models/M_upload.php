<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_upload extends CI_Model {
	public function get_upload()
	{
		return $this->db->query("
			select up.*, u.nama from upload up
			join detail_upload d ON up.id_upload = d.id_upload
			join user u ON d.id_user = u.id_user
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
		$this->db->insert_batch('detail_upload', $data);
	}

	public function getDetailUpload($id_upload){
		return $this->db->query("select du.* from upload u join detail_upload du on u.id_upload = du.id_upload where u.id_upload = '$id_upload'");
	}
}
