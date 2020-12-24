<?php

require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/dbconn.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
//----------------------------------------------------------------------------------//
$uname = $_POST['username'];
$password = $_POST['password'];
//----------------------------------------------------------------------------------//
$qlogin = mysqli_query($koneksi, "select count(*) as jumlah from user where username='" . $uname . "' and password='" . $password . "'");
$jumlah = mysqli_fetch_array($qlogin);
//----------------------------------------------------------------------------------//
if ($jumlah['jumlah'] > 0) {
    $_SESSION['userrole'] = 'admin';
    $_SESSION['username'] = $uname;
    header('location:../administrator/index');
} else {
    header('location:../');
}
//----------------------------------------------------------------------------------//
