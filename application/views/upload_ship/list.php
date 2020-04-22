<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ship To Party</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Upload</a></li>
          <li class="breadcrumb-item active">List</li>
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
          <a href="<?php echo base_url().'upload_ship/form'?>" class="btn btn-block bg-gradient-info btn-md"><i class="fa fa-plus"></i> Upload Data</a>
        </div>
        <div class="col-2" align="left">
        <a href="<?php echo base_url("excel/format/format.xlsx"); ?>" class="btn btn-block bg-gradient-success btn-md"><i class="fa fa-download"></i> Download Format</a>
        </div>
      </div>
      <hr/>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Data Ship To Party</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>User</th>
                <th>Tanggal</th>
                <th>Jumlah Baris</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach ($dataUpload as $row): ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$row->filename?></td>
                  <td><?=$row->nama?></td>
                  <td><?=$row->created_at?></td>
                  <td><?=$row->rows?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?php echo site_url('upload_ship/detail/'. $row->id_upload); ?>" class="btn btn-info"><i class="fa fa-info-circle"></i> Info</a>
                    </div>
                    <div class="btn-group">
                      <a href="<?php echo site_url('upload_ship/delete/'. $row->id_upload); ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                    </div>
                  </td>
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