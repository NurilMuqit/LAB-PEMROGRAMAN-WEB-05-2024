<?php

include 'config\conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $id = $_POST['idEdit'];
    $prodi = $_POST['prodi'];


    // prepared statement
    $query = $conn->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id=?");

    // ss itu untuk tipe data dari values
    $query->bind_param('sssi', $nama, $nim,$prodi, $id);
    
    
    if($query->execute()) {
        $conn->close();
        header('Location: dashboard.php');

    } else {
        echo "Error".$query->error;
    }

}