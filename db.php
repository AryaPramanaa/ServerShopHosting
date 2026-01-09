<?php
$host = "switchback.proxy.rlwy.net";
$user = "root";
$pass = "EkXcsAUuKRFsoZgLrABeEuqZnhwTSlCH";
$db   = "railway";
$port = 59813;

$connect = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Koneksi gagal");
}
