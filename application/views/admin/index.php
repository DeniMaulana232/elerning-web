<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $tittle; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/LTE/'); ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url('assets2/') ?>stisla-assets/css/components.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-school"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SDN 2 Badran Sari</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider ">

            <div class="sidebar-heading">
                Operator Sekolah
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">

                <a class="nav-link" href="<?= base_url('admin/index'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
                <?php foreach ($admin as $a) { ?>
                    <a class="nav-link" href="<?= base_url('admin/myProfile/') . $a->id; ?>">
                        <i class="fas fa-fw fa-user-alt"></i>
                        <span>Profilku</span></a>
                <?php } ?>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/data_mapel'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Matapelajaran</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kelola_user'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data User</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kelola_kelas'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/pertemuan'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pertemuan</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <h2 class="h4 text-gray-600 mb-1">WEBSITE PEMBELAJARAN DALAM JARINGAN SDN 2 BADRAN SARI</h2>


                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['username']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $tittle; ?></h1> -->

                    <div class="main-content">
                        <section class="section">
                            <div class="section-header">
                                <h1 style="font-size: 27px; letter-spacing:-0.5px; color:black;">Dashboard</h1>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><img src="<?= base_url('assets/img/sd.png'); ?>"></img></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Siswa</span>
                                            <span class="info-box-number"> <?php echo $this->db->count_all('siswa'); ?></span>
                                            <a href="<?= base_url('admin/data_siswa'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-red"><img src="<?= base_url('assets/img/guru.png'); ?>"></img></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Guru</span>
                                            <span class="info-box-number"> <?php echo $this->db->count_all('guru'); ?></span>
                                            <a href="<?= base_url('admin/data_guru'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix visible-sm-block"></div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Matapelajaran</span>
                                            <span class="info-box-number"><?php echo $this->db->count_all('mapel') ?></span>
                                            <a href="<?= base_url('admin/data_mapel'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Kelas</span>
                                            <span class="info-box-number"><?php echo $this->db->count_all('kelas'); ?></span>
                                            <a href="<?= base_url('admin/kelola_kelas'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- Page content -->

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary" style="font-size: larger">Aktifitas yang dapat dilakukan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-justify" style="font-size: larger">

                                        <div class="col-lg-20  col-md-6 col-sm-6">

                                            <ul class="list" style="color: blue">
                                                <li><a href="<?= base_url('admin/kelola_kelas') ?>">Kelola Kelas</a></li>
                                                <li><a href="<?= base_url('admin/kelola_user') ?>">Kelola Data User</a></li>
                                                <li><a href="<?= base_url('admin/data_mapel') ?>">Mata Pelajaran</a></li>
                                                <li><a href="<?= base_url('admin/pertemuan ') ?>">Pertemuan</a></li>
                                                <li><a href="<?= base_url('admin/pengumuman ') ?>">Pengumuman</a></li>
                                            </ul>

                                        </div>
                                    </div>

                                </div>
                            </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">pilih logout untuk meninggalkan halaman ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>

</body>

</html>