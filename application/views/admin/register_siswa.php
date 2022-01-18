<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg">
                    <div class="p-4">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tambah Siswa</h1>
                        </div>

                        <form class="user" method="POST" action="<?= base_url('admin/tambahsiswa') ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Siswa" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nisn" name="nisn" placeholder="Nomor induk siswa" value="<?= set_value('nisn'); ?>">
                                <?= form_error('nisn', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Tempat tinggal siswa" value="<?= set_value('alamat'); ?>">
                                <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                    <?= form_error('password2', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                            </div>
                            <button text="submit" class="btn btn-primary btn-user btn-block">
                                Register Siswa
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