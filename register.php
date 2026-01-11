<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php'; 

$email    = $_POST['email'];
$password = $_POST['password'];
$alamat   = $_POST['alamat'];
$no_hp    = $_POST['no_hp'];

if (empty($email) || empty($password) || empty($alamat) || empty($no_hp)) {
    echo json_encode([
        "success" => false,
        "message" => "Semua kolom (Email, Password, Alamat, No HP) wajib diisi!"
    ]);
    exit(); // Stop proses disini
}

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

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "success" => true,
            "message" => "Registrasi Berhasil"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Gagal: " . $conn->error
        ]);
    }
}

$conn->close();
