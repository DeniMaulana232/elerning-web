<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="description" content="">
    <meta name="author" content="">

    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px
        }

        .card2 {
            margin: 0px 40px
        }

        .logo {
            width: 200px;
            height: 100px;
            margin-top: 20px;
            margin-left: 35px
        }

        .image {
            width: 180px;
            height: 140px
        }

        .border-line {
            border-right: 1px solid #EEEEEE
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        a {
            color: inherit;
            cursor: pointer
        }

        .btn-blue {
            background-color: #1A237E;
            width: 150px;
            color: #fff;
            border-radius: 2px
        }

        .btn-blue:hover {
            background-color: #000;
            cursor: pointer
        }

        .bg-blue {
            color: #fff;
            background-color: #1A237E
        }
    </style>

</head>

<body oncontextmenu='return false' class='snippet-body'>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <!-- <div class="row"> <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> </div> -->
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img data-aos="fade-up" data-aos-duration="1800" src="<?= base_url('assets2/') ?>img/illustrations/index-study.svg" alt="" srcset=""></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">

                        </div>
                        <div class="row px-3 mb-4">
                            <small class="center">HAI, GURU SDN 2 DESA BADRAN SARI</small>
                            <!-- <div class="line"></div> -->
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" method="POST" action="<?= base_url('guru/authguru') ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan email anda..." value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan Password...">
                                <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>

                            <div class=" row px-3 mb-4">
                                <!-- <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a> -->
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Login</button> </div>
                        </form>
                        <!-- <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger ">Register</a></small> </div> -->
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>