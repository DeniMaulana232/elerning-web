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
                Guru
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">

                <a class="nav-link" href="<?= base_url('guru/guru/index'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('guru/guru/myProfile'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Profilku</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('guru/guru/data_mapel'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Tambah Materi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('guru/guru/data_pilgan'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Soal Pilihan Ganda</span></a>
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
                        <h1>
                            <small>
                                Selamat Datang, <?php
                                                $data['user'] = $this->db->get_where('guru', ['email' =>
                                                $this->session->userdata('email')])->row_array();
                                                echo $data['user']['nama'];
                                                ?>
                            </small>
                        </h1>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $guru['nama']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $guru['image']; ?>">
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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="font-size: xx-large">Tambah Materi</h6>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-body">
                            <?php echo form_open_multipart('guru/guru/tambah_materi', ['class' => 'form_horizontal']); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul Materi</label>
                                <input type="text" class="form-control " id="judul" name="judul" placeholder="Masukan deskripsi pelajaran" value="<?= set_value('judul'); ?>">
                                <?= form_error('judul', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi</label>
                                <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi pelajaran" value="<?= set_value('deskripsi'); ?>">
                                <?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                            <div class="form-group">

                                <?php foreach ($NamaGuru as $t) { ?>
                                    <input type="hidden" name="guru" class="form-control" id="guru" value="<?= $t->id_guru; ?>" readonly>
                                <?php } ?>

                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    <option value="">--Kelas--</option>
                                    <?php foreach ($kelas as $m) { ?>
                                        <option value="<?= $m->id_kelas; ?>"> <?php echo $m->nama_kelas; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel"> Matapelajaran</label>
                                <select class="form-control" id="mapel" name="mapel">
                                    <option value="">---Matapelajaran----</option>
                                    <?php foreach ($mapel as $p) { ?>
                                        <option value="<?= $p->id_mapel; ?>"><?php echo $p->nama_mapel; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel"> pertemuan</label>
                                <select class="form-control" id="pertemuan" name="pertemuan">
                                    <option value="">---Pertemuan ke----</option>
                                    <?php foreach ($pertemuan as $p) { ?>
                                        <option value="<?= $p->id_pertemuan; ?>">Pertemuan ke-<?php echo $p->no_pertemuan; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">

                                <label>Upload file pdf</label></br>
                                <input type="file" id="pdf" name="pdf">
                                <br />
                                <small>File type: pdf <br>Max size:2MB</small>
                                <small class="text-danger">
                                    <?php echo form_error('FileUpload') ?>
                                </small>
                            </div>
                            </br></br>
                            <label>Upload video pembelajaran</label></br>
                            <input type="file" id="video" name="video">
                            <br />
                            <small>File type: MP4, MKV </small>
                            <small class="text-danger">
                                <?php echo form_error('FileUpload') ?>
                            </small>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>

                        <!-- </div> -->
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">pilih logout untuk meninggalkan halaman ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('guru/authguru/logout'); ?>">Logout</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#kelas').change(function() {
                var id_kelas = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('guru/guru/getMapel') ?>",
                    data: {
                        id_kelas: id_kelas
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#mapel').html(response);
                    }
                });
            });
            $('#mapel').change(function() {
                var id_mapel = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('guru/guru/getPertemuan') ?>",
                    data: {
                        id_mapel: id_mapel
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#pertemuan').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>