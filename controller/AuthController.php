<?php

require($_SERVER['DOCUMENT_ROOT'] . '/perpustakaan_haifa/configuration/dbconn.php');

class AuthController
{
    public function AuthCheck($path1, $path2)
    {
        if (!isset($_SESSION['userrole'])) {
            $_SESSION['userrole'] = 'guest';
        } elseif ($_SESSION['userrole'] == 'guest') {
            //----------------------------------------------------------------------------------//
        } elseif ($_SESSION['userrole'] == 'admin') {
            //----------------------------------------------------------------------------------//
        }
        //----------------------------------------------------------------------------------//
        if ($_SESSION['userrole'] == 'guest') {
            header($path1);
        } elseif ($_SESSION['userrole'] == 'admin') {
            header($path2);
        }
    }
}
