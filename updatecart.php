<?php
// updatecart.php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

if (!isset($_POST['cart_id']) || !isset($_POST['quantity'])) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
    exit();
}

$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];

// Update jumlah di database
$sql = "UPDATE cart SET quantity = '$quantity' WHERE id = '$cart_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Update berhasil"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
