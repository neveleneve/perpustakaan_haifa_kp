<?php
$admin = new AdminController();
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/dbconn.php');
//----------------------------------------------------------------------------------//
// kondisi untuk tambah buku
if (isset($_POST['btn_add_buku'])) {
    $kodebuku = trim($_POST['kode']);
    $judulbuku = trim($_POST['judulbuku']);
    $penerbit = trim($_POST['penerbit']);
    $jumlah = trim($_POST['jumlah']);
    //----------------------------------------------------------------------------------//
    $admin->addBuku($kodebuku, $judulbuku, $penerbit, $jumlah);
    //----------------------------------------------------------------------------------//
    header('location:../administrator/buku');
}
if (isset($_POST['btn_ubah_buku'])) {
    $kodebukux = trim($_POST['kodebuku']);
    $namabukux = trim($_POST['namabuku']);
    $penerbitx = trim($_POST['penerbitbuku']);
    $jumlahx = trim($_POST['jumlahbuku']);
    echo $kodebukux . ' ' . $namabukux . ' ' . $penerbitx . ' ' . $jumlahx;
    //----------------------------------------------------------------------------------//
    $admin->ubahBuku($kodebukux, $namabukux, $penerbitx, $jumlahx);
    header('location:../administrator/buku');
}

if (isset($_POST['btn_selesai_peminjaman'])) {
    header('location:../administrator/peminjaman');
}

if (isset($_POST['btn_batal_peminjaman'])) {
    $kodepeminjamanx = $_POST['kodepeminjaman'];
    $admin->batalPeminjaman($kodepeminjamanx);
    header('location:../administrator/peminjaman');
}

if (isset($_POST['btn_input_peminjaman'])) {
    $kodepeminjamanx = $_POST['kodepeminjaman'];
    $idbukux = $_POST['idbuku'];
    $jumlahx = $_POST['jmlpinjam'];
    $namax = $_POST['namapeminjam'];
    $alamatx = $_POST['alamatpeminjam'];
    $jumlahbukupinjaman = $admin->hitungPinjaman($kodepeminjamanx);
    if ($jumlahbukupinjaman > 0) {
        $admin->inputPinjamBuku($kodepeminjamanx, $idbukux, $jumlahx, null, null);
    } else {
        $admin->inputPinjamBuku($kodepeminjamanx, $idbukux, $jumlahx, $namax, $alamatx);
    }
    sleep(2);
    header('location:../administrator/tambah-peminjaman?id_pinjam=' . $kodepeminjamanx);
}

class AdminController
{
    // Info
    public function getJumlahBuku()
    {
        global $koneksi;
        //----------------------------------------------------------------------------------//
        $qjumlahbuku = mysqli_query($koneksi, 'SELECT COUNT(*) AS jumlahbuku FROM buku');
        $jumlahbuku = mysqli_fetch_array($qjumlahbuku);
        //----------------------------------------------------------------------------------//
        $qjumlahpeminjaman = mysqli_query($koneksi, 'SELECT COUNT(*) AS jumlahpeminjaman FROM peminjaman');
        $jumlahpeminjaman = mysqli_fetch_array($qjumlahpeminjaman);
        //----------------------------------------------------------------------------------//
        $data = [
            'datajumlahjudulbuku' => $jumlahbuku['jumlahbuku'],
            'datajumlahpeminjaman' => $jumlahpeminjaman['jumlahpeminjaman']
        ];
        return $data;
    }
    //----------------------------------------------------------------------------------//
    // Buku
    public function getDataBuku($datasearch, $idbuku)
    {
        global $koneksi;
        //----------------------------------------------------------------------------------//
        if ($datasearch == '' || $datasearch == null || $idbuku == '' || $idbuku = null) {
            $qdatabuku = mysqli_query($koneksi, 'SELECT * FROM buku order by penerbit');
            $databuku = mysqli_fetch_all($qdatabuku);
        } elseif ($datasearch != null) {
            $qdatabuku = mysqli_query($koneksi, 'SELECT * FROM buku WHERE id_buku LIKE "%' . $datasearch . '%" OR penerbit LIKE "%' . $datasearch . '%" OR nama_buku LIKE "%' . $datasearch . '%"');
            $databuku = mysqli_fetch_all($qdatabuku);
        } elseif ($idbuku != null) {
            $qdatabuku = mysqli_query($koneksi, 'SELECT * FROM buku WHERE id_buku = "' . $idbuku . '"');
            $databuku = mysqli_fetch_all($qdatabuku);
        }
        //----------------------------------------------------------------------------------//
        return $databuku;
    }
    //----------------------------------------------------------------------------------//
    public function newIDBuku()
    {
        $randomchar = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
        $randomString = substr(str_shuffle("0123456789"), 0, 8);
        //----------------------------------------------------------------------------------//
        return $randomchar . $randomString;
    }
    //----------------------------------------------------------------------------------//
    public function addBuku($idbuku, $judulbuku, $penerbit, $jumlahbuku)
    {
        global $koneksi;
        $query = "INSERT INTO buku (id_buku, penerbit, nama_buku, stok) VALUES ('" . $idbuku . "', '" . $penerbit . "', '" . $judulbuku . "'," . $jumlahbuku . ")";
        mysqli_query($koneksi, $query);
    }
    //----------------------------------------------------------------------------------//
    public function ubahBuku($id, $nama, $penerbit, $jumlah)
    {
        global $koneksi;
        if ($nama == '' && $penerbit == '' && $jumlah == '') {
            # code...
        } else {
            $query = "UPDATE buku SET nama_buku=IF(LENGTH('$nama')=0, nama_buku, '$nama'), penerbit=IF(LENGTH('$penerbit')=0, penerbit, '$penerbit'), stok=IF(LENGTH('$jumlah')=0, stok, '$jumlah') WHERE id_buku='$id'";
        }
        mysqli_query($koneksi, $query);
    }

    // Peminjaman
    public function getDataPeminjaman($id)
    {
        global $koneksi;
        //----------------------------------------------------------------------------------//
        if ($id == null) {
            $qdatapeminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman");
            $datapeminjaman = mysqli_fetch_all($qdatapeminjaman);
        } else {
            $qdatapeminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
            $datapeminjaman = mysqli_fetch_all($qdatapeminjaman);
        }
        //----------------------------------------------------------------------------------//
        return $datapeminjaman;
    }
    //----------------------------------------------------------------------------------//
    public function getDataBukuPinjaman($id)
    {
        global $koneksi;
        //----------------------------------------------------------------------------------//
        $qdatapeminjaman = mysqli_query($koneksi, "SELECT l.id_buku AS id_buku, b.nama_buku AS nama_buku, b.penerbit AS penerbit, l.jumlah AS jumlah FROM list_peminjaman AS l JOIN buku AS b ON b.id_buku=l.id_buku WHERE id_peminjaman='$id'");
        $datapeminjaman = mysqli_fetch_all($qdatapeminjaman);
        //----------------------------------------------------------------------------------//
        return $datapeminjaman;
    }
    //----------------------------------------------------------------------------------//
    public function newIDPeminjaman()
    {
        $randomchar = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
        //----------------------------------------------------------------------------------//
        return $randomchar;
    }
    //----------------------------------------------------------------------------------//
    public function inputPinjamBuku($kode, $kodebuku, $jumlah, $namapeminjam, $alamatpeminjam)
    {
        global $koneksi;
        $tanggal = date('Y-m-d');
        if ($namapeminjam == null && $alamatpeminjam == null) {
            $query = "ALTER TABLE list_peminjaman AUTO_INCREMENT = 1; 
            INSERT INTO list_peminjaman (id_peminjaman, id_buku, jumlah) VALUES ('$kode', '$kodebuku', $jumlah); 
            UPDATE buku SET stok = stok - $jumlah WHERE id_buku='$kodebuku'";
        } else {
            $query = "ALTER TABLE list_peminjaman AUTO_INCREMENT = 1; 
            INSERT INTO list_peminjaman (id_peminjaman, id_buku, jumlah) VALUES ('$kode', '$kodebuku', $jumlah); 
            UPDATE buku SET stok = stok - $jumlah WHERE id_buku='$kodebuku';
            ALTER TABLE peminjaman AUTO_INCREMENT=1;
            INSERT INTO peminjaman (id_peminjaman, nama_peminjam, alamat_peminjam, status_input, tanggal_pinjam) VALUES ('$kode', '$namapeminjam', '$alamatpeminjam', 1, '$tanggal')";
        }
        if (mysqli_multi_query($koneksi, $query)) {
            # code...
        } else {
            echo 'error in Inputting Data Peminjaman Buku';
        }
    }
    //----------------------------------------------------------------------------------//
    public function hitungPinjaman($id)
    {
        global $koneksi;
        $query = "SELECT * FROM list_peminjaman WHERE id_peminjaman='$id'";
        $jumlahdata = mysqli_num_rows(mysqli_query($koneksi, $query));
        return $jumlahdata;
    }
    //----------------------------------------------------------------------------------//
    public function nambahBuku($idbuku, $jumlahbuku)
    {
        global $koneksi;
        $qnambahbuku = "UPDATE buku SET stok = stok + $jumlahbuku WHERE id_buku='$idbuku'";
        if (mysqli_query($koneksi, $qnambahbuku)) {
            echo 'bisa';
        } else {
            echo 'tak bisa';
        }
    }
    //----------------------------------------------------------------------------------//
    public function batalPeminjaman($id)
    {
        global $koneksi;
        $qhitungpinjaman = "SELECT * FROM list_peminjaman WHERE id_peminjaman='$id'";
        $hitungpinjaman = mysqli_query($koneksi, $qhitungpinjaman);
        $dataa = mysqli_fetch_all($hitungpinjaman);
        $rowcount = mysqli_num_rows($hitungpinjaman);

        if ($rowcount > 0) {
            for ($i = 0; $i < $rowcount; $i++) {
                $this->nambahBuku($dataa[$i][2], $dataa[$i][3]);
            }
            $queryhapus = "DELETE FROM list_peminjaman WHERE id_peminjaman='$id';
            DELETE FROM peminjaman WHERE id_peminjaman='$id'";
            if (mysqli_multi_query($koneksi, $queryhapus)) {
                # code...
            } else {
                echo 'error in Inputting Data Peminjaman Buku';
            }
        } else {
        }
    }
}
