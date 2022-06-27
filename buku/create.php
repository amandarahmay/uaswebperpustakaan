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
$kode_buku = $_POST['kode_buku'] ?? '';
$isbn = $_POST['isbn'] ?? 0;
$judul_buku = $_POST['judul_buku'] ?? '';
$pengarang = $_POST['pengarang'] ?? '';
$penerbit = $_POST['penerbit'] ?? 0;
$tahun_terbit = $_POST['tahun_terbit'] ?? '';
/**
 * Validation int value
 */
$jumlahFilter = filter_var($isbn, FILTER_VALIDATE_INT);

/**
 * Method OK
 * Validation OK
 * Prepare query
 */
try{
    $query = "INSERT INTO buku (kode_buku, isbn, judul_buku, pengarang, penerbit, tahun_terbit) 
VALUES (:kode_buku, :isbn, :judul_buku, :pengarang, :penerbit,  :tahun_terbit)";
    $statement = $connection->prepare($query);
    /**
     * Bind params
     */
    $statement->bindValue(":kode_buku", $kode_buku);
    $statement->bindValue(":isbn", $isbn, PDO::PARAM_INT);
    $statement->bindValue(":judul_buku", $judul_buku);
    $statement->bindValue(":pengarang", $pengarang);
    $statement->bindValue(":penerbit", $penerbit );
    $statement->bindValue(":tahun_terbit", $tahun_terbit);
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