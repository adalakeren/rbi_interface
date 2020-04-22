<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url() ?>assets/icon/ckb.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CKB Interface</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?php echo base_url() ?>assets/adminlte/dist/img/male.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">User</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url().'dashboard'?>" class="nav-link">
              <i class="nav-icon far fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'upload'?>" class="nav-link">
              <i class="nav-icon far fa fa-file-excel-o"></i>
              <p>
                Upload DN Number
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'upload_ship'?>" class="nav-link">
              <i class="nav-icon far fa fa-file-excel-o"></i>
              <p>
                Upload Ship To Party
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'login/logout'?>" onclick="return confirm('Apakah Anda Yakin Keluar?')" class="nav-link">
              <i class="nav-icon far fa fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
