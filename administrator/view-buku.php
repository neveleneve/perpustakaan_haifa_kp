<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/pagename.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AdminController.php');

$auth = new AuthController();
$admin = new AdminController();
$auth->AuthCheck('location:../login', null);

$databuku = $admin->getDataBuku(null, $_GET['id'])[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Buku</title>
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include '../layouts/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../layouts/navbar.php' ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Data Buku <?= $_GET['id'] ?></h1>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="btn btn-sm btn-danger btn-block" href="buku"><i class="fas fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Buku <?= $_GET['id'] ?></h6>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/AdminController.php" method="post">
                                        <label for="kodebuku">Kode Buku</label>
                                        <input type="text" id="kodebuku" name="kodebuku" class="form-control form-control-sm mb-3" value="<?= $_GET['id'] ?>" readonly>
                                        <label for="namabuku">Nama Buku</label>
                                        <input type="text" id="namabuku" name="namabuku" class="form-control form-control-sm mb-3" placeholder="<?= $databuku[3] ?>">
                                        <label for="penerbitbuku">Penerbit Buku</label>
                                        <input type="text" id="penerbitbuku" name="penerbitbuku" class="form-control form-control-sm mb-3" placeholder="<?= $databuku[2] ?>">
                                        <label for="jumlahbuku">Jumlah Buku</label>
                                        <input type="number" id="jumlahbuku" name="jumlahbuku" class="form-control form-control-sm mb-3" min="1" placeholder="<?= $databuku[4] ?>">
                                        <button type="submit" class="btn btn-sm btn-primary btn-block" id="btn_ubah_buku" name="btn_ubah_buku">Ubah Data Buku</button>
                                    </form>
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