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
          <a href="<?php echo base_url().'upload_ship'?>" class="btn btn-block bg-gradient-info btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
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
              <th  style="vertical-align: middle;">No Row</th>
              <th  style="vertical-align: middle;">Ship To Party</th>
              <th  style="vertical-align: middle;">Country</th>
              <th  style="vertical-align: middle;">Customer Name</th>
              <th  style="vertical-align: middle;">Addres Line 1</th>
              <th  style="vertical-align: middle;">Addres Line 1</th>
              <th  style="vertical-align: middle;">City</th>
              <th  style="vertical-align: middle;">Postal Code</th>
              <th  style="vertical-align: middle;">Telpon 1</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no=1;
            foreach ($detaildata as $row): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=$row->ship_to_party?></td>
                <td><?=$row->country?></td>
                <td><?=$row->customer_name?></td>
                <td><?=$row->addres1?></td>
                <td><?=$row->addres2?></td>
                <td><?=$row->city?></td>
                <td><?=$row->postal_code?></td>
                <td><?=$row->telephone?></td>
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