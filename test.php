<?php

$str = '2020-2-2';
if (($timestamp = strtotime('+2 day', strtotime($str))) !== false) {
    $php_date = getdate($timestamp);
    // or if you want to output a date in year/month/day format:
    $date = date("Y/m/d", $timestamp); // see the date manual page for format options      
    echo $date;
} else {
    echo 'invalid timestamp!';
}
