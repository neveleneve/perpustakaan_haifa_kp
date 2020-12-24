<?php
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/controller/AuthController.php');
$auth = new AuthController();
$auth->AuthCheck('location:../login', 'location:dashboard');
