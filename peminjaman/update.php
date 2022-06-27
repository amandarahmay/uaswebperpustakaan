<?php
include '../koneksi.php';

$id_peminjaman = isset($_POST['id_peminjaman']) ? $_POST['id_peminjaman'] : '';
$id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : '';
$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
$judul_buku = isset($_POST['judul_buku']) ? $_POST['judul_buku'] : '';
$tanggal_meminjam = isset($_POST['tanggal_meminjam']) ? $_POST['tanggal_meminjam'] : '';
$tanggal_kembali = isset($_POST['tanggal_kembali']) ? $_POST['tanggal_kembali'] : '';


/***@var $connection PDO */

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE peminjaman SET id_pelanggan = '$id_pelanggan', isbn = '$isbn',judul_buku = '$judul_buku', tanggal_meminjam = '$tanggal_meminjam', tanggal_kembali = '$tanggal_kembali' WHERE `id_peminjaman`= '$id_peminjaman'";

    $connection->exec($sql);
    echo "Data berhasil di update";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;