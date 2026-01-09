<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// koneksi database
require_once 'db.php';

// query ambil semua produk
$sql = "SELECT id,name,price,promo,description,images,stocks,vendor,category FROM product_items WHERE category = 'Sepatu Pria'";
$result = $conn->query($sql);

$products = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();
