<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

$email    = $_POST['email'];
$password = $_POST['password']; 

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $password_di_db = $row['password']; 

    if (password_verify($password, $password_di_db)) {
        
        // LOGIN SUKSES
        echo json_encode([
            "success" => true,
            "message" => "Login Berhasil",
            "data"    => [
                "id"     => $row['id'],
                "email"  => $row['email'],
                "alamat" => $row['alamat'],
                "no_hp"  => $row['no_hp']
            ]
        ]);

    } else {
        echo json_encode([
            "success" => false,
            "message" => "Password Salah"
        ]);
    }

} else {
    // Email tidak ditemukan
    echo json_encode([
        "success" => false,
        "message" => "Email tidak terdaftar"
    ]);
}

$connect->close();
