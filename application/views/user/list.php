<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">List User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">User</a></li>
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
          <a href="<?php echo base_url().'user/add'?>" class="btn btn-block bg-gradient-info btn-md"><i class="fa fa-plus"></i> Tambah User</a>
        </div>
      </div>
      <hr/>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Data User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Akses</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach ($dataUser as $row): ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$row->nama?></td>
                  <td><?=$row->email?></td>
                  <td><?=$row->akses?></td>
                  <td><?=$row->status?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?php echo site_url('user/edit/'. $row->id_user); ?>" class="btn btn-warning"><i class="fa fa-edit"></i>Edit</a>
                      <!-- <a href="<?php echo site_url('event/hapus/'. $row->id_event); ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-default"><i class="fa fa-trash"></i>Delete</a> -->
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