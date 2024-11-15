<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengguna</title>
</head>
<body>
    <?php
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        echo "<h1>Halo, $username! Ini halaman pengguna.</h1>";
    } else {
        echo "<h1>Anda harus masuk terlebih dahulu.</h1>";
        echo '<a href="masuk.php">Login di sini</a>'; // Link untuk login
    }
    ?>
</body>
</html>
