<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php'; 

$cekEmail = "SELECT * FROM users WHERE email = '$email'";
$result   = $conn->query($cekEmail);

if ($result->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Email sudah digunakan, gunakan email lain."
    ]);
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password, alamat, no_hp) 
            VALUES ('$email', '$hashed_password', '$alamat', '$no_hp')";

    if ($connect->query($sql) === TRUE) {
        echo json_encode([
            "success" => true,
            "message" => "Registrasi Berhasil"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Gagal: " . $connect->error
        ]);
    }
}

$conn->close();
