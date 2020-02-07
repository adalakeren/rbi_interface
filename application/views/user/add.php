<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">User</a></li>
          <li class="breadcrumb-item active">Tambah</li>
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
            <h3 class="card-title">Form Tambah User</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo base_url("user/create"); ?>" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Masukkan nama" name="nama" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan email" name="email" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
              </div>
              <div class="form-group">
                <label>Akses</label>
                <select class="custom-select" name="akses">
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                  <option value="supervisor">Supervisor</option>
                  <option value="manager">Manager</option>
                </select>
              </div>
            </div>
            <div class="card-footer">              
              <input class="btn btn-info" type="submit" name="submit" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

