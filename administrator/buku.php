<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/pagename.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AdminController.php');

$auth = new AuthController();
$admin = new AdminController();
$auth->AuthCheck('location:../login', null);
$databuku = null;
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    $databuku = $admin->getDataBuku($cari, null);
} else {
    $databuku = $admin->getDataBuku(null, null);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
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
                        <h1 class="h3 mb-0 text-gray-900">Buku</h1>
                    </div>
                    <hr>
                    <?php
                    if (isset($_POST['cari'])) {
                    ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 mb-3">
                                <form action="" method="post">
                                    <input id="cari" name="cari" class="form-control form-control-sm" type="text" placeholder="Cari Buku" value="<?= $_POST['cari'] ?>" required>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 mb-3">
                                <a class="btn btn-primary btn-sm btn-block" href="buku"><i class="fas fa-sync"></i> Segarkan</a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 mb-3">
                                <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modaltambahbuku"><i class="fas fa-plus"></i> Tambah Buku</button>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 mb-3">
                                <form action="" method="post">
                                    <input id="cari" name="cari" class="form-control form-control-sm" type="text" placeholder="Cari Buku" required>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 mb-3">
                                <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modaltambahbuku"><i class="fas fa-plus"></i> Tambah Buku</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-bordered">
                                    <thead class="text-light text-center bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Buku</th>
                                            <th>Penerbit</th>
                                            <th>Judul Buku</th>
                                            <th>Tersedia</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark text-center text-nowrap">
                                        <?php
                                        $no = 1;
                                        if (count($databuku) > 0) {
                                            foreach ($databuku as $data) {
                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data[1] ?></td>
                                                    <td>
                                                        <?= $data[2] ?>
                                                    </td>
                                                    <td><?= $data[3] ?></td>
                                                    <td><?= $data[4] ?> Buku</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="view-buku?id=<?= $data[1] ?>">View Buku</a>
                                                        <?php
                                                        if ($data[4] == 0) {
                                                        ?>
                                                            <a class="btn btn-sm btn-danger" href="hapusbuku?id=<?= $data[1] ?>" onclick="return confirm('Yakin Menghapus Data Buku?')">Hapus Buku</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Data Buku Kosong</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltambahbuku">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="../controller/AdminController.php" method="POST">
                    <div class="modal-body">
                        <label for="kode">ID</label>
                        <input class="form-control form-control-sm mb-3" type="text" name="kode" id="kode" value="<?= $admin->newIDBuku() ?>" readonly>
                        <label for="judulbuku">Judul</label>
                        <input class="form-control form-control-sm mb-3" type="text" name="judulbuku" id="judulbuku" placeholder="Judul" required>
                        <label for="penerbit">Penerbit</label>
                        <input class="form-control form-control-sm mb-3" type="text" name="penerbit" id="penerbit" placeholder="Penerbit" required>
                        <label for="jumlah">Jumlah</label>
                        <input class="form-control form-control-sm mb-3" type="number" name="jumlah" id="jumlah" placeholder="Jumlah" min="1" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary" type="submit" id="btn_add_buku" name="btn_add_buku">Tambah Buku</button>
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/jquery/jquery.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
