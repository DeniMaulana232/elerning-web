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

    <!-- <link rel="stylesheet" href="<?= base_url('assets/LTE'); ?> /bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('assets/LTE'); ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/LTE'); ?>/dist/css/AdminLTE.min.css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .scroll {
            height: 200px;
            overflow: scroll;
        }
    </style>
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
                <a class="nav-link" href="<?= base_url('admin/myProfile'); ?>">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Profilku</span></a>
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
                    <div class="text-center">
                        <h2 class="h4 text-gray-600 mb-1">WEBSITE PEMBELAJARAN DALAM JARINGAN SDN 2 BADRAN SARI</h2>
                    </div>

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
                <!-- Begin Page Content -->


                <div class="container-fluid">
                    <div class="card o-hidden border-0 shadow-lg my-1 col-lg-7 mx-auto">
                        <div class="card-body p-0">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-4">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Tambah Pertemuan</h1>
                                        </div>

                                        <form class="user" method="POST" action="<?= base_url('admin/tambah_pertemuan') ?>">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pertemuan ke-</label>
                                                <input type="text" class="form-control form-control-user" id="nomor" name="nomor" placeholder="Nomor Pertemuan" value="<?= set_value('nomor'); ?>">
                                                <?= form_error('nomor', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select class="form-control" id="kelas" name="kelas">
                                                    <option value="">---Pilih Kelas---</option>
                                                    <?php foreach ($kelas as $m) { ?>
                                                        <option value="<?= $m->id_kelas; ?>"> <?php echo $m->nama_kelas; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Matapelajaran</label>
                                                <select class="form-control" id="mapel" name="mapel">
                                                    <option value="">---Pilih Kelas---</option>
                                                    <?php foreach ($mapel as $m) { ?>
                                                        <option value="<?= $m->id_mapel; ?>"> <?php echo $m->nama_mapel; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <button text="submit" class="btn btn-primary btn-user btn-block">
                                                Tambahkan Data
                                            </button>
                                            <hr>
                                        </form>
                                        <div class="text-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets/LTE'); ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/LTE'); ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?= base_url('assets/LTE'); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kelas').change(function() {
                var id_kelas = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('admin/getMapel') ?>",
                    data: {
                        id_kelas: id_kelas
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#mapel').html(response);
                    }
                });
            });
        });
    </script>


</body>

</html>