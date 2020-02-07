<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('M_upload');
        if($this->session->userdata('logined') != true){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['dataUpload'] = $this->M_upload->get_upload()->result();
        //var_dump($data['dataUpload']);die;
        $data['pageContent'] = 'upload/list';

        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }       
    }

    public function form()
    {
        //set nama file disini
        $filename = $this->session->userdata('id_user').'_'.date('Y-m-d H-i-s');
        //var_dump($filename);die;

        $data = array(); // Buat variabel $data sebagai array
        
        if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
            // lakukan upload file dengan memanggil function upload yang ada di Model Upload
            $upload = $this->M_upload->upload_file($filename);
            //var_dump($upload['file']['file_name']);die;
            
            if($upload['result'] == "success"){ // Jika proses upload sukses
                // Load plugin PHPExcel nya
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';                
                
                $excelreader = new PHPExcel_Reader_Excel2007();
                $loadexcel = $excelreader->load('excel/'.$upload['file']['file_name']); // Load file yang tadi diupload ke folder excel
                $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

                // Validasi Format
                if ($sheet[2]['A'] == 'No' && $sheet[2]['B'] == 'Kode Customer' && $sheet[2]['C'] == 'Nama Customer' && $sheet[2]['D'] == 'DN' && $sheet[2]['E'] == 'Tujuan' && $sheet[2]['F'] == 'Carton' && $sheet[3]['F'] == 'Pallet' && $sheet[3]['G'] == 'S' && $sheet[3]['H'] == 'M' && $sheet[3]['I'] == 'L' && $sheet[3]['J'] == 'Total Coli') {
                    // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
                    // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                    $data['file_name'] = $upload['file']['file_name'];
                    $data['sheet'] = $sheet; 
                }else{ // Jika format salah
                    $data['upload_error'] = 'Format File Salah'; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
                }
            }else{ // Jika proses upload gagal
                $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }

        $data['pageContent'] = 'upload/form';
        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }       
    }

    public function import(){

        $filename = $this->input->post('file_name');

        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$filename); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

        //insert ke tabel upload
        $data = [
            'filename' => $filename,
            'rows' => count($sheet)-3, //kurang 3 baris, title tidak dihitung
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('upload', $data);
        $id_upload = $this->db->insert_id();        
        
        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data = array();
        
        $numrow = 1;
        foreach($sheet as $row){
            // Cek $numrow apakah lebih dari 3
            // Artinya karena baris pertama sampai ketiga adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 3){
                // Kita push (add) array data ke variabel data
                array_push($data, array(
                    'id_user' => $this->session->userdata('id_user'),
                    'id_upload' => $id_upload,
                    'no'=>$row['A'], // Insert data no dari kolom A di excel
                    'kode_customer'=>$row['B'], // Insert data kode_customer dari kolom B di excel
                    'nama_customer'=>$row['C'], // Insert data nama_customer dari kolom C di excel
                    'dn'=>$row['D'], // Insert data dn dari kolom D di excel
                    'tujuan'=>$row['E'], // Insert data tujuan dari kolom E di excel
                    'pallet'=>$row['F'], // Insert data pallet dari kolom F di excel
                    's'=>$row['G'], // Insert data s dari kolom G di excel
                    'm'=>$row['H'], // Insert data m dari kolom H di excel
                    'l'=>$row['I'], // Insert data l dari kolom I di excel
                    'total_coli'=>$row['J'], // Insert data total_coli dari kolom J di excel
                ));
            }
            
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $this->M_upload->insert_multiple($data);

        //Kirim ke email
        $email = $this->session->userdata('email');
        $this->kirim_email($email, $filename);

        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload File Berhasil !!</div></div>");
        redirect("upload"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }

    public function kirim_email($email, $filename){
        $this->load->library('email');

        $config = array();
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'Codeigniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "masukkan email pengirim"; // isi dengan email kamu
        $config['smtp_pass']= "masukkan password email"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;
        //memanggil library email dan set konfigurasi untuk pengiriman email
        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject("Upload File Berhasil");
        $this->email->message(
          "<b>Selamat, Upload File Excel Berhasil.</b><br>Berikut ini dilampirkan file tersebut.");
        $letak_file = base_url('excel/'.$filename);
        $nama_file = 'File Excel';
        $this->email->attach($letak_file, 'attachment', $nama_file);
        //var_dump($this->email->send());
        $this->email->send();
        //var_dump(show_error($this->email->print_debugger()));die;    
        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }

    public function detail($id_upload)
    {
        $data['detaildata'] = $this->M_upload->getDetailUpload($id_upload)->result();
        $data['pageContent'] = 'upload/detail';

        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }  
    }

    public function delete($id_upload)
    {
        $this->db->delete('upload', array('id_upload' => $id_upload));
        $this->db->delete('detail_upload', array('id_upload' => $id_upload));

        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Hapus File Berhasil !!</div></div>");
        redirect('upload', 'refresh'); 
    }

    public function back()
    {
        $filename = $this->input->get('file_name');
                // $file_path = './excel/'.$filename;
                // chmod($file_path, 0777);
                // unlink($file_path);

        $data['dataUpload'] = $this->M_upload->get_upload()->result();
        $data['pageContent'] = 'upload/list';

        if($this->session->userdata('akses') == 'admin'){
            $this->load->view('layout_admin', $data);
        }else{
            $this->load->view('layout', $data);
        }       
    }
}
