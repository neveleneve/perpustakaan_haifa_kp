<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/pagename.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AdminController.php');

$auth = new AuthController();
$admin = new AdminController();
$auth->AuthCheck('location:../login', null);

if (isset($_GET['id'])) {
    $idpeminjaman = $_GET['id'];
    $datapeminjaman = $admin->getPeminjaman($idpeminjaman);
} else {
    header('location:peminjaman');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
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
                        <h1 class="h3 mb-0 text-gray-900">Lihat Peminjaman</h1>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Peminjaman Buku</h6>
                                </div>
                                <div class="card-body">
                                    <label for="kodepeminjaman">Kode Peminjaman</label>
                                    <input type="text" id="kodepeminjaman" name="kodepeminjaman" class="form-control form-control-sm mb-3" value="<?= $idpeminjaman ?>" disabled>
                                    <label for="namapeminjam">Nama Peminjam</label>
                                    <input type="text" value="<?= $datapeminjaman[0][1] ?>" id="namapeminjam" name="namapeminjam" class="form-control form-control-sm mb-3" readonly>
                                    <label for="alamatpeminjam">Alamat Peminjam</label>
                                    <textarea type="text" id="alamatpeminjam" name="alamatpeminjam" class="form-control form-control-sm mb-3" readonly><?= $datapeminjaman[0][2] ?></textarea>
                                    <div class="table-responsive text-nowrap mb-3">
                                        <table class="table table-hover table-bordered mb-3">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Buku</th>
                                                    <th>Judul Buku</th>
                                                    <th>Penerbit</th>
                                                    <th>Jumlah Pinjam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($datapeminjaman as $key) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $key[4] ?></td>
                                                        <td><?= $key[6] ?></td>
                                                        <td><?= $key[5] ?></td>
                                                        <td><?= $key[3] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <?php
                                        if ($datapeminjaman[0][7] == null) {
                                        ?>
                                            <div class="col-6">
                                                <a href="peminjaman" class="btn btn-sm btn-danger btn-block">Kembali</a>
                                            </div>
                                            <div class="col-6">
                                                <form action="../controller/AdminController.php" method="post">
                                                    <input type="hidden" name="id_peminjaman" id="id_peminjaman" value="<?= $idpeminjaman ?>">
                                                    <button onclick="return confirm('Lakukan Pengembalian?')" type="submit" id="pengembalian" name="pengembalian" class="btn btn-sm btn-primary btn-block">Pengembalian</button>
                                                </form>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-12">
                                                <a href="peminjaman" class="btn btn-sm btn-danger btn-block">Kembali</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
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
    <script type="text/javascript">
        function deletereq() {
            $('#namapeminjam').removeAttr('required');
            $('#alamatpeminjam').removeAttr('required');
            $('#nomorbuku').removeAttr('required');
            $('#jmlpinjam').removeAttr('required');
        }
    </script>
</body>

</html>