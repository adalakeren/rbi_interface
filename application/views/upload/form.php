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
                    <th rowspan="2" style="vertical-align: middle;">No</th>
                    <th rowspan="2" style="vertical-align: middle;">Kode Customer</th>
                    <th rowspan="2" style="vertical-align: middle;">Nama Customer</th>
                    <th rowspan="2" style="vertical-align: middle;">DN</th>
                    <th rowspan="2" style="vertical-align: middle;">Tujuan</th>
                    <th colspan="5" style="text-align: center;">Carton</th>
                  </tr>
                    <tr>
                      <th style="text-align: center;">Pallet</th>
                      <th style="text-align: center;">S</th>
                      <th style="text-align: center;">M</th>
                      <th style="text-align: center;">L</th>
                      <th style="text-align: center;">Total Coli</th>
                    </tr>

                  <?php 
                    $numrow = 1;
                    $kosong = 0;

                    // Lakukan perulangan dari data yang ada di excel
                    // $sheet adalah variabel yang dikirim dari controller
                    foreach($sheet as $row){
                      // Ambil data pada excel sesuai Kolom
                      $no = $row['A']; // Ambil data no
                      $kode_customer = $row['B']; // Ambil data kode_customer
                      $nama_customer = $row['C']; // Ambil data nama_customer
                      $dn = $row['D']; // Ambil data dn
                      $tujuan = $row['E']; // Ambil data tujuan
                      $pallet = $row['F']; // Ambil data pallet
                      $s = $row['G']; // Ambil data s
                      $m = $row['H']; // Ambil data m
                      $l = $row['I']; // Ambil data l
                      $total_coli = $row['J']; // Ambil data total_coli

                      // Cek jika semua data tidak diisi
                      if($no == "" && $kode_customer == "" && $nama_customer == "" && $dn == "" && $tujuan == "" && $pallet == "" && $s == "" && $m == "" && $l == "" && $total_coli == "")
                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                      // Cek $numrow apakah lebih dari 2
                      // Artinya karena baris kedua adalah nama-nama kolom
                      // Jadi dilewat saja, tidak usah diimport
                      if($numrow > 2){
                        // Validasi apakah semua data telah diisi
                        $no_td = ( ! empty($no))? "" : " style='background: #E07171;'"; // Jika no kosong, beri warna merah
                        $kode_customer_td = ( ! empty($kode_customer))? "" : " style='background: #E07171;'"; // Jika kode_customer kosong, beri warna merah
                        $nama_customer_td = ( ! empty($nama_customer))? "" : " style='background: #E07171;'"; // Jika nama_customer kosong, beri warna merah
                        $dn_td = ( ! empty($dn))? "" : " style='background: #E07171;'"; // Jika dn kosong, beri warna merah
                        $tujuan_td = ( ! empty($tujuan))? "" : " style='background: #E07171;'"; // Jika tujuan kosong, beri warna merah
                        $pallet_td = ( ! empty($pallet))? "" : " style='background: #E07171;'"; // Jika pallet kosong, beri warna merah
                        $s_td = ( ! empty($s))? "" : " style='background: #E07171;'"; // Jika s kosong, beri warna merah
                        $m_td = ( ! empty($m))? "" : " style='background: #E07171;'"; // Jika m kosong, beri warna merah
                        $l_td = ( ! empty($l))? "" : " style='background: #E07171;'"; // Jika l kosong, beri warna merah
                        $total_coli_td = ( ! empty($total_coli))? "" : " style='background: #E07171;'"; // Jika total_coli kosong, beri warna merah

                        // Jika salah satu data ada yang kosong
                        if($no == "" or $kode_customer == "" or $nama_customer == "" or $dn == "" or $tujuan == "" or $pallet == "" or $s == "" or $m == "" or $l == "" or $total_coli == ""){
                          $kosong++; // Tambah 1 variabel $kosong
                        }

                        echo "<tr>";
                        echo "<td".$no_td.">".$no."</td>";
                        echo "<td".$kode_customer_td.">".$kode_customer."</td>";
                        echo "<td".$nama_customer_td.">".$nama_customer."</td>";
                        echo "<td".$dn_td.">".$dn."</td>";
                        echo "<td".$tujuan_td.">".$tujuan."</td>";
                        echo "<td".$pallet_td.">".$pallet."</td>";
                        echo "<td".$s_td.">".$s."</td>";
                        echo "<td".$m_td.">".$m."</td>";
                        echo "<td".$l_td.">".$l."</td>";
                        echo "<td".$total_coli_td.">".$total_coli."</td>";
                        echo "</tr>";
                      }

                      $numrow++; // Tambah 1 setiap kali looping
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

