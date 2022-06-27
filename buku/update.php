<?php
include '../koneksi.php';

$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
$kode_buku = isset($_POST['kode_buku']) ? $_POST['kode_buku'] : '';
$judul_buku = isset($_POST['judul_buku']) ? $_POST['judul_buku'] : '';
$pengarang = isset($_POST['pengarang']) ? $_POST['pengarang'] : '';
$penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
$tahun_terbit = isset($_POST['tahun_terbit']) ? $_POST['tahun_terbit'] : '';

/***@var $connection PDO */

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE buku SET kode_buku = '$kode_buku', judul_buku = '$judul_buku',pengarang = '$pengarang', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit' WHERE `isbn`= '$isbn'";

    $connection->exec($sql);
    echo "Data berhasil di update";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;