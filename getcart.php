<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

$user_id = $_GET['user_id']; 


$sql = "SELECT 
            cart.id AS cart_id,
            cart.quantity,
            product_items.id AS product_id,
            product_items.name,     
            product_items.price,
            product_items.images    
        FROM cart
        JOIN product_items ON cart.product_id = product_items.id
        WHERE cart.user_id = '$user_id'";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "success" => true,
        "data" => $data
    ]);
} else {
    echo json_encode([
        "success" => true,
        "data" => [], 
        "message" => "Keranjang kosong"
    ]);
}

$conn->close();
