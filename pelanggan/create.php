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
$id_pelanggan = $_POST['id_pelanggan'] ?? 0;
$nama = $_POST['nama'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$tanggal_lahir = $_POST['tanggal_lahir'] ?? date('Y-m-d');
$telepon = $_POST['telepon'] ?? 0;
$alamat = $_POST['alamat'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
/**
 * Validation int value
 */
$jumlahFilter = filter_var($id_pelanggan, $telepon, FILTER_VALIDATE_INT);

/**
 * Method OK
 * Validation OK
 * Prepare query
 */
try{
    $query = "INSERT INTO pelanggan (id_pelanggan, nama, jenis_kelamin, tanggal_lahir, telepon, alamat, username, password) 
VALUES (:id_pelanggan, :nama, :jenis_kelamin, :tanggal_lahir, :telepon,  :alamat, :username, :password)";
    $statement = $connection->prepare($query);
    /**
     * Bind params
     */
    $statement->bindValue(":id_pelanggan", $id_pelanggan, PDO::PARAM_INT);
    $statement->bindValue(":nama", $nama);
    $statement->bindValue(":jenis_kelamin", $jenis_kelamin);
    $statement->bindValue(":tanggal_lahir", $tanggal_lahir);
    $statement->bindValue(":telepon", $telepon, PDO::PARAM_INT);
    $statement->bindValue(":alamat", $alamat);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":password", $password);
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