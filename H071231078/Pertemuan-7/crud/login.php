<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

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
    $stmt = $conn->prepare("SELECT username, password FROM pert7 WHERE username = ?");
    $stmt->bind_param("s", $username);  // "s" menunjukkan string
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifikasi pengguna
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set sesi pengguna setelah berhasil login
            $_SESSION["username"] = $username;
            header("Location: halaman_pengguna.php");
            exit();
        } else {
            echo "Autentikasi gagal. Silakan coba lagi.";
        }
    } else {
        echo "Autentikasi gagal. Silakan coba lagi.";
    }

    // Menutup koneksi dan statement
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Masuk</title>
</head>
<body>
    <h1>Formulir Masuk</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>
