<?php
$server_name = 'localhost:3307';
$username = 'root';
$pass = '';
$database = 'tp7';

$conn = new mysqli($server_name,$username, $pass, $database);


if ($conn->connect_error) {
    die("Koneksi gagal". $conn->connect_error);
} 
// else {
//     echo "Koneksi berhasil";
// };




?>

