<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/pagename.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AdminController.php');

$auth = new AuthController();
$admin = new AdminController();
$auth->AuthCheck('location:../login', null);

$databuku = $admin->getDataBuku(null, null);
if (isset($_GET['id_pinjam'])) {
    $idpeminjaman = $_GET['id_pinjam'];
    $jumlahbukupinjaman = $admin->hitungPinjaman($idpeminjaman);
    $datapinjaman = $admin->getDataBukuPinjaman($idpeminjaman);
    $datapeminjam = $admin->getDataPeminjaman($idpeminjaman);
} else {
    $idpeminjaman = $admin->newIDPeminjaman();
    $jumlahbukupinjaman = $admin->hitungPinjaman($idpeminjaman);
    $datapinjaman = $admin->getDataBukuPinjaman($idpeminjaman);
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
                        <h1 class="h3 mb-0 text-gray-900">Tambah Peminjaman</h1>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Peminjaman Buku</h6>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/AdminController.php" method="post">
                                        <label for="kodepeminjaman">Kode Peminjaman</label>
                                        <input type="text" id="kodepeminjaman" name="kodepeminjaman" class="form-control form-control-sm mb-3" value="<?= $idpeminjaman ?>" readonly>
                                        <label for="namapeminjam">Nama Peminjam</label>
                                        <input type="text" value="<?= isset($_GET['id_pinjam']) ? $datapeminjam[0][2] : null ?>" id="namapeminjam" name="namapeminjam" class="form-control form-control-sm mb-3" placeholder="Nama Peminjam" required <?= isset($_GET['id_pinjam']) ? 'readonly' : null ?>>
                                        <label for="alamatpeminjam">Alamat Peminjam</label>
                                        <textarea type="text" id="alamatpeminjam" name="alamatpeminjam" class="form-control form-control-sm mb-3" placeholder="Alamat Peminjam" required <?= isset($_GET['id_pinjam']) ? 'readonly' : null ?>><?= isset($_GET['id_pinjam']) ? $datapeminjam[0][3] : null ?></textarea>
                                        <label for="daftarbuku">Daftar Buku</label>
                                        <div class="row">
                                            <div class="col-5">
                                                <input list="idbuku" id="nomorbuku" name="idbuku" class="form-control form-control-sm mb-3" placeholder="Cari ID Buku" required>
                                                <datalist id="idbuku">
                                                    <?php
                                                    foreach ($databuku as $key) {
                                                    ?>
                                                        <option value="<?= $key[1] ?>"><?= $key[3] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                            <div class="col-5">
                                                <input type="number" id="jmlpinjam" name="jmlpinjam" class="form-control form-control-sm mb-3" placeholder="Jumlah Pinjam" min="1" required>
                                            </div>
                                            <div class="col-2">
                                                <button type="submit" class="btn btn-sm btn-info btn-block" id="btn_input_peminjaman" name="btn_input_peminjaman">Simpan</button>
                                            </div>
                                        </div>
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
                                                    if ($jumlahbukupinjaman > 0) {
                                                        foreach ($datapinjaman as $key) {
                                                    ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $key[0] ?></td>
                                                                <td><?= $key[1] ?></td>
                                                                <td><?= $key[2] ?></td>
                                                                <td><?= $key[3] ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="5">
                                                                <h1 class="h3 text-center">Belum Ada Peminjaman</h1>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-sm btn-danger btn-block" id="btn_batal_peminjaman" name="btn_batal_peminjaman" onclick="deletereq()">Batal</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-sm btn-primary btn-block" id="btn_selesai_peminjaman" name="btn_selesai_peminjaman" onclick="deletereq()">Selesai</button>
                                            </div>
                                        </div>
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