<?php
$dbuser = "root";
$dbpassword = "";
$dbserver = "localhost";
$dbname = "webperpustakaan";

$dsn = "mysql:host={$dbserver};dbname={$dbname}";

$connection = null;
try{
    $connection = new PDO($dsn, $dbuser, $dbpassword);
}catch (Exception $exception){
    die("Terjadi error:{$exception->getMessage()}");
}