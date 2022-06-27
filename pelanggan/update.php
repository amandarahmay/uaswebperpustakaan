<?php
include '../koneksi.php';

$id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
$tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
$telepon = isset($_POST['telepon']) ? $_POST['telepon'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


/***@var $connection PDO */

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE pelanggan SET nama = '$nama', jenis_kelamin = '$jenis_kelamin',tanggal_lahir = '$tanggal_lahir', telepon = '$telepon', alamat = '$alamat', username = '$username', password = '$password' WHERE `id_pelanggan`= '$id_pelanggan'";

    $connection->exec($sql);
    echo "Data berhasil di update";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;