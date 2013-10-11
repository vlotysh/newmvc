<?php

/*
 * Файл для обращения к базе данных
 */


$dblocation = "localhost";
$dbname = "mvcshop";
$dbuser = "root";
$dbpasswd = "";


$db = mysql_connect($dblocation, $dbuser, $dbpasswd,$dbname);

if(!$db) {
    echo 'Упсс.....ошибка доступа';
    exit();
}

mysql_set_charset('utf-8');

mysql_select_db($dbname);