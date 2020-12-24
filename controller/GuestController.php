<?php

require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/dbconn.php');

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    if ($uname != '' && $password != '') {
        $this->login($uname, $password);
    }
}

class GuestController
{
    
}
echo 0;