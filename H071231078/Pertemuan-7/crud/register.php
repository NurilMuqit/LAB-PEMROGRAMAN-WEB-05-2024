<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Koneksi ke database
    $server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "pertemuan-7";
    $conn = new mysqli($server, $db_username, $db_password, $db_name);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("INSERT INTO pert7 (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password); // "ss" menunjukkan kedua parameter adalah string

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran Pengguna</title>
</head>
<body>
    <h1>Formulir Pendaftaran Pengguna</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
