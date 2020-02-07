<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail File Excel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Upload</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<?=$this->session->flashdata('pesan')?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">      
      <div class="row">
        <div class="col-2" align="left">
          <a href="<?php echo base_url().'upload'?>" class="btn btn-block bg-gradient-info btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <!-- <div class="col-2" align="left">
        <a href="<?php echo base_url("excel/format/format.xlsx"); ?>" class="btn btn-block bg-gradient-success btn-md"><i class="fa fa-download"></i> Download Format</a>
      </div> -->
    </div>
    <hr/>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Detail File Excel</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-striped"> 
          <thead>                 
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
          </thead>
          <tbody>
            <?php 
            $no=1;
            foreach ($detaildata as $row): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=$row->kode_customer?></td>
                <td><?=$row->nama_customer?></td>
                <td><?=$row->dn?></td>
                <td><?=$row->tujuan?></td>
                <td><?=$row->pallet?></td>
                <td><?=$row->s?></td>
                <td><?=$row->m?></td>
                <td><?=$row->l?></td>
                <td><?=$row->total_coli?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
                    <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Chat ID</th>
                        <th>Username</th>
                        <th>Tanggal</th>
                    </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </section>
  <!-- /.content -->