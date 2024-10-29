<?php
include 'config\conn.php';

$id = $_POST['idDelete'];

$query = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
$query->bind_param('i', $id);

if($query->execute()){
    $conn->close();
    header('Location: dashboard.php');
} else {
    echo 'Error: '. $query->error;
}