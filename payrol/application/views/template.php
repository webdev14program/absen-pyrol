<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $web->nama ?> | <?= $title . ' ' . ucfirst($this->session->userdata('level')) ?></title>
  <link href="<?php echo base_url(); ?>assets/img/<?= $web->logo ?>" rel="icon" type="image/png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- datatables -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand  navbar-light" style="background-color: #003b6f">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span class="nav-link" style="color: white">
            <?= $this->M_data->hari(date('D')) . ', ' . $this->M_data->tgl_indo(date('Y-m-d')); ?>
          </span>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #003b6f">
      <!-- Brand Logo -->
      <a href="#" class="brand-link ">
        <img src="<?= base_url('assets/') ?>img/<?= $web->logo ?>" alt="Logo <?= $web->nama ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $web->nama ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">
              <small>User login :</small><br> <b><?= $this->session->userdata('nama') ?> ( <?= $this->session->userdata('level') ?> )</b>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url($this->session->userdata('level')) ?>" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard </p>
              </a>
            </li>

            <!-- hanya ditampilkan jika user admin yang login -->
            <?php if ($this->session->userdata('level') == 'admin') { ?>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>
                    Master Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/departemen" class="nav-link">
                      <i class="fa fa-building nav-icon"></i>
                      <p>Departemen</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/jabatan" class="nav-link">
                      <i class="fa fa-building nav-icon"></i>
                      <p>Jabatan</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/statuspegawai" class="nav-link">
                      <i class="fa fa-user-plus nav-icon"></i>
                      <p>Status Pegawai</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/pegawai" class="nav-link">
                      <i class="fa fa-users nav-icon"></i>
                      <p>Pegawai</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/pengangkatan" class="nav-link">
                      <i class="fa fa-users nav-icon"></i>
                      <p>Pengangkatan Pegawai</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="<?= base_url($this->session->userdata('level')) ?>/absensi" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p> List Absensi </p>
              </a>
            </li>
            <?php if ($this->session->userdata('level') == 'admin') { ?>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-fingerprint"></i>
                  <p>
                    Absensi
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/pengaturanmesin" class="nav-link">
                      <i class="nav-icon fas fa-cogs"></i>
                      <p> Pengaturan Mesin</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/pengaturanabsen" class="nav-link">
                      <i class="nav-icon fas fa-cogs"></i>
                      <p> Pengaturan Absensi</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Pengajuan Surat
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item" style="margin-left:20px">
                  <a href="<?= base_url($this->session->userdata('level')) ?>/cuti" class="nav-link">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>Cuti</p>
                  </a>
                </li>
                <li class="nav-item" style="margin-left:20px">
                  <a href="<?= base_url($this->session->userdata('level')) ?>/perjalanandinas" class="nav-link">
                    <i class="fa fa-plane nav-icon"></i>
                    <p>Perjalanan Dinas</p>
                  </a>
                </li>
              </ul>
            </li>
            <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'manajer') { ?>
              <li class="nav-item">
                <a href="<?= base_url($this->session->userdata('level')) ?>/mutasi" class="nav-link">
                  <i class="nav-icon fas fa-calendar-plus"></i>
                  <p>Mutasi</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($this->session->userdata('level') == 'admin') { ?>
              <li class="nav-item">
                <a href="<?= base_url($this->session->userdata('level')) ?>/penggajian" class="nav-link">
                  <i class="nav-icon fas fa-university"></i>
                  <p> Penggajian </p>
                </a>
              </li>
            <?php } ?>
            <?php if ($this->session->userdata('level') == 'admin') { ?>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Master Data Gaji
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/pekerjaan" class="nav-link">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Data Gaji</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/pinjaman" class="nav-link">
                      <i class="fa fa-credit-card nav-icon"></i>
                      <p>Pinjaman</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <?php if ($this->session->userdata('level') == 'admin') { ?>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Riwayat Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/riwayatmutasi" class="nav-link">
                      <i class="fa fa-calendar-plus nav-icon"></i>
                      <p>Mutasi</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left:20px">
                    <a href="<?= base_url($this->session->userdata('level')) ?>/riwayatgaji" class="nav-link">
                      <i class="fa fa-folder-open nav-icon"></i>
                      <p>Gaji</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a onclick="return confirm('apakah anda yakin ingin keluar ?')" href="<?= base_url('auth') ?>/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p> Keluar </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url($this->session->userdata('level')) ?>">Home</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <?php $this->load->view($body); ?>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="background-color: #f27501; color: white">
      <strong>Copyright &copy;<?= date('Y') ?> <a href="#" style="color: white"><?= $web->nama ?></a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        Develop by <b><?= $web->author ?></b>
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url('assets/') ?>plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url('assets/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('assets/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url('assets/') ?>dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>
  <!-- datatables -->
  <script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"> </script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"> </script>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#table').DataTable({});
    });
  </script>

  <!-- sweetalert -->
  <script src="<?php echo base_url('assets/') ?>alert.js"></script>
  <?php echo "<script>" . $this->session->flashdata('message') . "</script>" ?>
</body>

</html>