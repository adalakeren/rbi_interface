<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
</script>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Upload File Excel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Upload</a></li>
          <li class="breadcrumb-item active">Form</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Form Upload</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo base_url("upload/form"); ?>" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <!-- <label for="exampleInputFile">File input</label> -->
                <div class="input-group">
                  <!-- <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div> -->
                  <input type="file" name="file" id="customFile">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <!-- <button type="submit" name="preview" class="btn btn-info">Preview</button> -->
              <input class="btn btn-info" type="submit" name="preview" value="Preview">
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php if(isset($_POST['preview'])):?>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Preview</h3>
            </div>
            <div class="card-body">
              <?php if(isset($upload_error)):?>
                <div style='color: red;'><?=$upload_error?></div>
                <?php die; ?>
              <?php endif ?>
              <form method="post" action="<?php echo base_url("upload/import"); ?>">                
                <hr/>
                <div style='color: red;' id='kosong'>Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.</div>
                <div id="btnImport"></div>
                <hr/>
                <table class="table table-bordered table-striped">                  
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;">No Row</th>
                    <th rowspan="2" style="vertical-align: middle;">Kode Ship To Party</th>
                    <th rowspan="2" style="vertical-align: middle;">Nama Customer</th>
                    <th rowspan="2" style="vertical-align: middle;">DN</th>
                    <th colspan="5" style="text-align: center;">Carton</th>
                  </tr>
                    <tr>
                      <th style="text-align: center;">Pallet</th>
                      <th style="text-align: center;">S</th>
                      <th style="text-align: center;">M</th>
                      <th style="text-align: center;">L</th>
                    </tr>

                  <?php 
                    $numrow = 1;
                    $kosong = 0;
                    ini_set("max_execution_time", 'time_limit');
                    ini_set('memory_limit', '1024M'); //your memory limit as string

                    // Lakukan perulangan dari data yang ada di excel
                    // $sheet adalah variabel yang dikirim dari controller
                    $no_row_data = 0;
                    foreach($sheet as $row){
                      

                      // Ambil data pada excel sesuai Kolom
                      $cr_date = $row['A']; // Ambil data no
                      $nomor_dn = $row['B']; // Ambil data nomor dn
                      $customer_name = $row['C']; // Ambil data nomor dn
                      $ship_to_party = $row['D']; // Ambil data ship to party

                      
                      $s1 = $row['E']; // Ambil data s1
                      $s2 = $row['F']; // Ambil data s2
                      $m1 = $row['G']; // Ambil data m
                      $m2 = $row['H']; // Ambil data m
                      $l = $row['I']; // Ambil data l
                      $pallet = $row['J']; // Ambil data pallet
                      
                      //$total_coli = $row['J']; // Ambil data total_coli

                      // Cek jika semua data tidak diisi
                      if($nomor_dn == "" && $ship_to_party == "")
                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                      //$get_data_upload = $this->M_upload->getDataUpload($nomor_dn);
                      //if(empty($get_data_upload->dn)){

                      // Cek $numrow apakah lebih dari 2
                      // Artinya karena baris kedua adalah nama-nama kolom
                      // Jadi dilewat saja, tidak usah diimport
                      if($numrow > 1){
                        // Validasi apakah semua data telah diisi
                        $kode_customer_td = ( ! empty($ship_to_party))? "" : " style='background: #E07171;'"; // Jika kode_customer kosong, beri warna merah
                        $customer_name_td = ( ! empty($customer_name))? "" : " style='background: #E07171;'"; // Jika kode_customer kosong, beri warna merah

                        //$ship_to_party = ( ! empty($ship_to_party))? "" : " style='background: #E07171;'"; // Jika kode_customer kosong, beri warna merah
                        $dn_td = ( ! empty($nomor_dn))? "" : " style='background: #E07171;'"; // Jika dn kosong, beri warna merah

                        $cr_date_td = ( ! empty($cr_date))? "" : " style='background: #E07171;'"; 

                        
                        

                        // Jika salah satu data ada yang kosong
                        if($nomor_dn == "" or $ship_to_party == "" or $customer_name == ""){
                          $kosong++; // Tambah 1 variabel $kosong
                        }

                        if($s1 != ""){
                          $s = $s1;
                        }
                        else if($s2 != ""){
                          $s = $s2;
                        }
                        else{
                          $s = "";
                        }

                        if($m1 != ""){
                          $m = $m1;
                        }
                        else if($m2 != ""){
                          $m = $m2;
                        }
                        else{
                          $m = "";
                        }
                        
                        
                          echo "<tr>";
                          echo "<td ".$cr_date_td.">".$no_row_data."</td>";
                          echo "<td".$kode_customer_td.">".$ship_to_party."</td>";
                          echo "<td".$customer_name_td.">".$customer_name."</td>";
                          echo "<td".$dn_td.">".$nomor_dn."</td>";
                          echo "<td>".$pallet."</td>";
                          echo "<td>".$s."</td>";
                          echo "<td>".$m."</td>";
                          echo "<td>".$l."</td>";
                          echo "</tr>";
                        
                      }

                      $numrow++; // Tambah 1 setiap kali looping
                      $no_row_data++;

                      //}
                    }
                  ?>
                </table>

                <?php if($kosong > 0): ?>
                    <script>
                      $(document).ready(function(){
                      // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                      $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                      $("#kosong").show(); // Munculkan alert validasi kosong
                      });
                    </script>
                <?php else: ?> 
                    <hr/>      

                    <?php $filename = 'import_data4';  ?>            
                    <script>
                      $(document).ready(function(){
                        $("#btnImport").append(`<a href="<?php echo base_url('upload'); ?>" id='btnCancel' class='btn btn-danger'><i class="fa fa-chevron-left"></i> Cancel</a> <button type='submit' name='import' class='btn btn-success'><i class="fa fa-cloud-upload"></i> Import</button>
                        `);
                      });
                    </script>
                <?php endif ?>

                <input type="hidden" name="file_name" value="<?php echo $file_name; ?>">
              </form>
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>





</section>

