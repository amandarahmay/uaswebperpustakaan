<?php
include '../koneksi.php';

/***
 * @var $connection PDO
 */

$isbn = $_POST['isbn'];
try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "Delete FROM buku WHERE `isbn`= '$isbn'";

    $connection->exec($sql);
    echo "Data berhasil di hapus";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;