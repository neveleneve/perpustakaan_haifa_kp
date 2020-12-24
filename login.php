<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
$auth = new AuthController();
$auth->AuthCheck(null, 'location:administrator/dashboard');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-7 bg-gradient-dark">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 font-weight-bold text-gray-200 mb-2">Sistem Informasi Perpustakaan</h1>
                                        <h1 class="h5 font-weight-bold text-gray-400 mb-4">SD Negeri 001 Toapaya</h1>
                                    </div>
                                    <form action="controller/LoginController" method="POST" class="user">
                                        <div id="message" class="text-center text-gray-100"></div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Nama Pengguna">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Kata Sandi">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="submit" id="btn_login" name="btn_login" class="btn btn-dark btn-user btn-block" value="Login">
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <a class="small text-gray-100" href="forgot-password">Lupa Kata Sandi?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/jquery/jquery.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/js/sb-admin-2.min.js"></script>

</body>

</html>