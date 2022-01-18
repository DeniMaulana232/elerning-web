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
                <a class="nav-link" href="#">
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

                <div class="container">
                    <div class="main-content">
                        <section class="section">
                            <div class="card o-hidden border-0 shadow-lg my-5 col-lg-12 mx-auto">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="p-4">

                                                <div class="table-responsive">
                                                    <tbody>
                                                        <form id="formsoal" role="form" method="POST" action="<?= base_url('ujian/jawab_aksi') ?>" onsubmit="return confirm('Anda Yakin ?')">
                                                            <div class="form-group">
                                                                <?php foreach ($user as $row) { ?>
                                                                    <input type="hidden" name="id_peserta" class="form-control" id="id_peserta" value="<?= $row->id; ?>" readonly>
                                                                <?php } ?>
                                                                <?php foreach ($temu as $row) { ?>
                                                                    <input type="hidden" name="temu" class="form-control" id="temu" value="<?= $row->id_pertemuan; ?>" readonly>
                                                                <?php } ?>
                                                                <?php foreach ($temu as $row) { ?>
                                                                    <input type="hidden" name="guru" class="form-control" id="guru" value="<?= $row->id_guru; ?>" readonly>
                                                                <?php } ?>
                                                                <?php foreach ($temu as $row) { ?>
                                                                    <input type="hidden" name="mapel" class="form-control" id="mapel" value="<?= $row->id_mapel; ?>" readonly>
                                                                <?php } ?>


                                                            </div>
                                                            <?php $no = 0;
                                                            foreach ($soal as $row) {
                                                                $no++ ?>

                                                                <tr>
                                                                    <td width="1%"><?php echo $no; ?>.</td>
                                                                    <td><?php echo $row->soal; ?>
                                                                        <input type='hidden' name='soal[]' value='<?php echo $row->id_soal; ?>' /> <br>
                                                                        <input type="radio" name="jawaban[<?php echo $row->id_soal; ?>]" value="A" required /> <?php echo $row->opsi_a; ?><br>
                                                                        <input type="radio" name="jawaban[<?php echo $row->id_soal; ?>]" value="B" required /> <?php echo $row->opsi_b; ?><br>
                                                                        <input type="radio" name="jawaban[<?php echo $row->id_soal; ?>]" value="C" required /> <?php echo $row->opsi_c; ?><br>
                                                                        <input type="radio" name="jawaban[<?php echo $row->id_soal; ?>]" value="D" required /> <?php echo $row->opsi_d; ?><br>
                                                                    </td>
                                                                </tr>
                                                                <br />
                                                            <?php } ?>
                                                            <input type="hidden" name="jumlah_soal" value="<?php echo $no; ?>">
                                                            <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                                                        </form>
                                                        <!-- <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian/jawab_aksi" method="post" onsubmit="return confirm('Anda Yakin ?')">

                                                            <input type="hidden" name="id_peserta" value="<?php echo $id['id']; ?>">
                                                            <input type="hidden" name="jumlah_soal" value="<?php echo $total_soal; ?>">

                                                            <?php $no = 0;
                                                            foreach ($soal as $s) {
                                                                $no++ ?>
                                                                <div class="form-group">
                                                                    <table class="table table-bordered table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="1%"><?php echo $no; ?>.</td>
                                                                                <td><?php echo $s->soal; ?>
                                                                                    <input type='hidden' name='soal[]' value='<?php echo $s->id_soal_ujian; ?>' /> <br>
                                                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal; ?>]" value="A" required /> <?php echo $s->opsi_a; ?><br>
                                                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal; ?>]" value="B" required /> <?php echo $s->opsi_b; ?><br>
                                                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal; ?>]" value="C" required /> <?php echo $s->opsi_c; ?><br>
                                                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal; ?>]" value="D" required /> <?php echo $s->opsi_d; ?><br>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            <?php } ?>
                                                            <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                                                        </form> -->
                                                    </tbody>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
        <script src="<?= base_url('assets'); ?>/js/myscript.js"></script>
        <script src="<?= base_url('assets/package/dist'); ?>/sweetalert2.all.min.js"></script>

</body>

</html>