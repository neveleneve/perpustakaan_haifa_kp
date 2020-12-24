<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
unset($_SESSION["userrole"]);
unset($_SESSION["username"]);
session_destroy();

$auth = new AuthController();
$auth->AuthCheck('location:../', null);