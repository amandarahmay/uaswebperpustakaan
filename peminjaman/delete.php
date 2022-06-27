<?php
include '../koneksi.php';

/***
 * @var $connection PDO
 */

$id_peminjaman = $_POST['id_peminjaman'];
try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "Delete FROM peminjaman WHERE `id_peminjaman`= '$id_peminjaman'";

    $connection->exec($sql);
    echo "Data berhasil di hapus";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;