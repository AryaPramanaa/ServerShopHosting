<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

if (!isset($_POST['cart_id'])) {

    echo json_encode([
        "success" => false, 
        "message" => "Gagal: Parameter cart_id tidak diterima server."
    ]);
    exit(); // Stop proses
}


$cart_id = $_POST['cart_id']; 


$sql = "DELETE FROM cart WHERE id = '$cart_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "success" => true, 
        "message" => "Item berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "success" => false, 
        "message" => "Gagal Database: " . $conn->error
    ]);
}

$conn->close();
