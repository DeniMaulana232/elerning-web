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
    <!-- <link rel="stylesheet" href="<?= base_url('assets/LTE/'); ?>dist/css/AdminLTE.min.css"> -->
    <link href="<?= base_url('assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="<?= base_url('assets2/') ?>stisla-assets/css/components.css"> -->
    <link href="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <!-- main content -->
                <div class="container">
                    <div class="main-content">
                        <section class="section">
                            <div class="card o-hidden border-0 shadow-lg my-5 col-lg-12 mx-auto">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="p-4">
                                                <?= $this->session->flashdata('message'); ?>
                                                <?php echo form_open_multipart('guru/guru/soal_uploaded') ?>
                                                <div class="box">
                                                    <div class="box-header with-border">
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
                                                            <label for="pertemuan"> pertemuan</label>
                                                            <select class="form-control" id="pertemuan" name="pertemuan">
                                                                <option value="">---Pertemuan ke----</option>
                                                                <?php foreach ($pertemuan as $p) { ?>
                                                                    <option value="<?= $p->id_pertemuan; ?>">Pertemuan ke-<?php echo $p->no_pertemuan; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="materi"> materi</label>
                                                            <select class="form-control" id="materi" name="materi">
                                                                <option value="">---Materi----</option>
                                                                <?php foreach ($materi as $m) { ?>
                                                                    <option value="<?= $m->id_materi; ?>"><?php echo $m->judul_materi; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-sm-8 col-sm-offset-2">
                                                                <div class="form-group col-sm-12">
                                                                    <div class="col-sm-12">
                                                                        <label for="soal" class="control-label">Soal</label>
                                                                        <div class="form-group">
                                                                            <input type="file" name="file_soal" class="form-control">
                                                                            <small class="help-block" style="color: #dc3545"><?= form_error('file_soal') ?></small>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea name="soal" id="soal" class="form-control froala-editor"><?= set_value('soal') ?></textarea>
                                                                            <small class="help-block" style="color: #dc3545"><?= form_error('soal') ?></small>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Membuat perulangan A-E -->

                                                                    <div class="col-sm-12">
                                                                        <label for="file">Jawaban A</label>
                                                                        <div class="form-group">
                                                                            <textarea name="jawaban_a" id="jawaban_a" class="form-control froala-editor"><?= set_value('jawaban_a') ?></textarea>
                                                                            <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_a') ?></small>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <label for="file">Jawaban B</label>
                                                                        <div class="form-group">
                                                                            <textarea name="jawaban_b" id="jawaban_b" class="form-control froala-editor"><?= set_value('jawaban_b') ?></textarea>
                                                                            <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_b') ?></small>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <label for="file">Jawaban C</label>
                                                                        <div class="form-group">
                                                                            <textarea name="jawaban_c" id="jawaban_c" class="form-control froala-editor"><?= set_value('jawaban_c') ?></textarea>
                                                                            <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_c') ?></small>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <label for="file">Jawaban D</label>
                                                                        <div class="form-group">
                                                                            <textarea name="jawaban_d" id="jawaban_d" class="form-control froala-editor"><?= set_value('jawaban_d') ?></textarea>
                                                                            <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_d') ?></small>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-sm-12">
                                                                        <label for="jawaban" class="control-label">Kunci Jawaban</label>
                                                                        <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                                                            <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                                                            <option value="A">A</option>
                                                                            <option value="B">B</option>
                                                                            <option value="C">C</option>
                                                                            <option value="D">D</option>
                                                                        </select>
                                                                        <small class="help-block" style="color: #dc3545"><?= form_error('jawaban') ?></small>
                                                                    </div>
                                                                    <div class="form-group col-sm-12">
                                                                        <label for="bobot" class="control-label">Bobot Soal</label>
                                                                        <input required="required" value="1" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                                                                        <small class="help-block" style="color: #dc3545"><?= form_error('bobot') ?></small>
                                                                    </div>
                                                                    <div class="form-group pull-right">
                                                                        <a href="<?= base_url('guru/guru/data_pilgan') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Batal</a>
                                                                        <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>

                <!-- end content -->

                <!-- footer -->
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
                        <a class="btn btn-primary" href="<?= base_url('guru/authguru/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets'); ?>/js/demo/datatables-demo.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>

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
                $('#pertemuan').change(function() {
                    var id_pertemuan = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('guru/guru/getMateri') ?>",
                        data: {
                            id_pertemuan: id_pertemuan
                        },
                        dataType: "JSON",
                        success: function(response) {
                            $('#materi').html(response);
                        }
                    });
                });
            });
        </script>
</body>

</html>