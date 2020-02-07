<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">User</a></li>
          <li class="breadcrumb-item active">Edit</li>
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
            <h3 class="card-title">Form Edit User</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo base_url("user/update"); ?>" enctype="multipart/form-data">
            <?php  
            foreach ($editdata as $data):
              ?>
              <div class="card-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" value="<?php echo $data->nama ?>" name="nama" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $data->email ?>" name="email" required>
                </div>
                <div class="form-group">
                  <label>Akses</label>
                  <select class="custom-select" name="akses">
                    <option value="admin"<?php if ($data->akses == 'admin') echo ' selected="selected"'; ?>>Admin</option>
                    <option value="user"<?php if ($data->akses == 'user') echo ' selected="selected"'; ?>>User</option>
                    <option value="supervisor"<?php if ($data->akses == 'supervisor') echo ' selected="selected"'; ?>>Supervisor</option>
                    <option value="manager"<?php if ($data->akses == 'manager') echo ' selected="selected"'; ?>>Manager</option>                   
                </select>
              </div>
            </div>
            <div class="card-footer">              
              <input class="btn btn-info" type="submit" name="submit" value="Submit">
            </div>

            <input type="hidden" name="id_user" value="<?php echo $data->id_user ?>">
          <?php endforeach ?>
        </form>
      </div>
    </div>
  </div>
</div>
</section>

