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

    <style>
        .scroll {
            height: 400;
            overflow: scroll;
        }

        .wrapper {
            text-align: center;
        }

        .button {
            position: absolute;
            top: 50%;
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
                Siswa
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">

                <a class="nav-link" href="<?= base_url('siswa/siswa/index'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Aktifitas
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('siswa/siswa/myProfile'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Profilku</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!--     Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $siswa['nama_siswa']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $siswa['image']; ?>">
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
                    <div class="main-content">
                        <section class="section">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <h2 class="card-title" style="font-size: larger; color: black;">Kerjakan lah Latihan atau Ujian tersebut dengan baik dan benar</h2>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">file</th>
                                                        <th scope="col">Judul</th>
                                                        <th scope="col">Aksi</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($prepare as $p) { ?>
                                                        <tr>

                                                            <td>
                                                                <?php echo $p->judul_materi ?>
                                                            </td>
                                                            <td>
                                                                <?php echo 'pertemuan ke-' . $p->no_pertemuan ?>
                                                            </td>
                                                        <?php } ?>

                                                        <?php foreach ($prepare as $c => $val) { ?>
                                                            <td>
                                                                <a href="<?= base_url('ujian/review/' . $val->id_pertemuan); ?>">Review</a>
                                                            </td>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?= $this->session->flashdata('message'); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">

                                    </div>
                                    <br />
                                    <div class="wrapper">
                                        <?php foreach ($prepare as $row => $val) { ?>
                                            <a href="<?= base_url('ujian/index/' . $val->id_pertemuan); ?>" class="btn btn-primary">Mulai Kerjakan</a>
                                        <?php  } ?>
                                    </div>
                                </div>

                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; By Deni Maulana Shobri</span>
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
    <!-- tugas modal  -->
    <!-- <div class="modal fade" id="tugas" tabindex="-1" role="dialog" aria-labelledby="newdataguruLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newdataguruLabel">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php foreach ($tugas as $row) { ?>
                        <?php echo form_open_multipart('') ?>

                        <div class="form-group">
                            <?php foreach ($tugas as $t) { ?>
                                <input type="hidden" name="kelas" class="form-control" id="kelas" value="<?= $t->id_guru; ?>" readonly>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <?php foreach ($siswaa as $a) { ?>
                                <input type="hidden" name="siswa" class="form-control" id="siswa" value="<?= $a->id; ?>" readonly>
                            <?php } ?>
                        </div>
                        <label>Upload file jawabanmu</label>
                        <input type="file" id="file" name="file">
                        <br />
                        <small>File type: gif, png, jpeg, jpg<br>Max size:2MB</small>
                        <small class="text-danger">
                            <?php echo form_error('FileUpload') ?>
                        </small>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#alert" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                        <?php echo form_close() ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="tugas" tabindex="-1" role="dialog" aria-labelledby="newdataguruLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <a class="btn btn-primary" href="<?= base_url('siswa/authuser/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/package/dist/'); ?>/sweetalert2.all.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/myscript.js"></script>
    <script src="<?= base_url('assets/package/dist'); ?>/sweetalert2.all.min.js"></script>

    <script>
        const tombol = document.querySelector('#tombol');
        tombol.addEventListener('click', function() {
            Swal.fire({
                tittle: 'hello world',
                text: 'latihan',
                icon: 'success',
                confirmButtonText: 'ok'


            });
        });
    </script>

</body>

</html>