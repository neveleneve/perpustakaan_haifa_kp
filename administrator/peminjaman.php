<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/pagename.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AdminController.php');

function namabulan($nomor)
{
    switch ($nomor) {
        case 1:
            return 'Januari';
            break;
        case 2:
            return 'Februari';
            break;
        case 3:
            return 'Maret';
            break;
        case 4:
            return 'April';
            break;
        case 5:
            return 'Mei';
            break;
        case 6:
            return 'Juni';
            break;
        case 7:
            return 'Juli';
            break;
        case 8:
            return 'Agustus';
            break;
        case 9:
            return 'September';
            break;
        case 10:
            return 'Oktober';
            break;
        case 11:
            return 'November';
            break;
        case 12:
            return 'Desember';
            break;
    }
}
$auth = new AuthController();
$admin = new AdminController();
$auth->AuthCheck('location:../login', null);
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
} else {
    $cari = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
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
                        <h1 class="h3 mb-0 text-gray-900">Peminjaman</h1>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-9">
                            <form action="" method="post">
                                <input id="cari" name="cari" class="form-control form-control-sm" type="text" value="<?= $cari ?>" placeholder="Cari Peminjaman">
                            </form>
                        </div>
                        <div class="col-3">
                            <a class="btn btn-primary btn-sm btn-block" href="tambah-peminjaman"><i class="fas fa-plus"></i> Tambah Peminjaman</a>
                        </div>
                    </div>
                    <?php
                    if (isset($cari)) {
                    ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-warning btn-block" href="peminjaman">Segarkan</a>
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
                                            <th>ID Peminjaman</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark text-center">
                                        <?php
                                        $no = 1;
                                        if (count($admin->getDataPeminjaman($cari)) > 0) {
                                            foreach ($admin->getDataPeminjaman($cari) as $data) {
                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data[1] ?></td>
                                                    <td>
                                                        <?= strtoupper($data[2]) ?>
                                                    </td>
                                                    <td>
                                                        <?= date('d', strtotime($data[5])) . ' ' .  namabulan(date('m', strtotime($data[5]))) . ' ' . date('Y', strtotime($data[5])) ?>
                                                    </td>
                                                    <td>

                                                        <?= $data[6] == null ? "-" : date('d', strtotime($data[6])) . ' ' .  namabulan(date('m', strtotime($data[6]))) . ' ' . date('Y', strtotime($data[6])) ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($data[6] == null) {
                                                            echo "Dipinjam";
                                                        } else {
                                                            echo "Dikembalikan";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="view-peminjaman?id=<?= $data[1] ?>">Lihat Peminjaman</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Data Peminjaman Kosong</td>
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
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/jquery/jquery.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/perpustakaan_haifa/template/js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
