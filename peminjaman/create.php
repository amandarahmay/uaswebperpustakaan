<?php
include '../koneksi.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(400);
    $reply['error'] = 'POST method required';
    echo json_encode($reply);
    exit();
}
/**
 * Get input data POST
 */
$id_peminjaman = $_POST['id_peminjaman'] ?? 0;
$id_pelanggan = $_POST['id_pelanggan'] ?? 0;
$isbn = $_POST['isbn'] ?? 0;
$judul_buku = $_POST['judul_buku'] ?? '';
$tanggal_meminjam = $_POST['tanggal_lahir'] ?? date('Y-m-d');
$tanggal_kembali = $_POST['tanggal_kembali'] ?? date('Y-m-d');
/**
 * Validation int value
 */
$jumlahFilter = filter_var($id_peminjaman, FILTER_VALIDATE_INT);

/**
 * Method OK
 * Validation OK
 * Prepare query
 */
try{
    $query = "INSERT INTO peminjaman (id_peminjaman, id_pelanggan, isbn, judul_buku, tanggal_meminjam, tanggal_kembali) 
VALUES (:id_peminjaman, :id_pelanggan, :isbn, :judul_buku, :tanggal_meminjam, :tanggal_kembali)";
    $statement = $connection->prepare($query);
    /**
     * Bind params
     */
    $statement->bindValue(":id_peminjaman", $id_peminjaman, PDO::PARAM_INT);
    $statement->bindValue(":id_pelanggan", $id_pelanggan, PDO::PARAM_INT);
    $statement->bindValue(":isbn", $isbn, PDO::PARAM_INT);
    $statement->bindValue(":judul_buku", $judul_buku);
    $statement->bindValue(":tanggal_meminjam", $tanggal_meminjam);
    $statement->bindValue(":tanggal_kembali", $tanggal_kembali);
    /**
     * Execute query
     */
    $isOk = $statement->execute();
}catch (Exception $exception){
    $reply['error'] = $exception->getMessage();
    echo json_encode($reply);
    http_response_code(400);
    exit(0);
}
/**
 * If not OK, add error info
 * HTTP Status code 400: Bad request
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Status#client_error_responses
 */
if(!$isOk){
    $reply['error'] = $statement->errorInfo();
    http_response_code(400);
}

/**
 * Show output to client
 * Set status info true
 */
$reply['status'] = $isOk;
echo json_encode($reply);