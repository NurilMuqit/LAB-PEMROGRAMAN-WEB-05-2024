<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

include 'config/conn.php'; // Koneksi ke database

// Cek jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Query untuk mencocokkan email atau username dengan password
    $query = $conn->prepare("SELECT * FROM mahasiswa WHERE (email = ? OR username = ?)");
    $query->bind_param("ss", $login, $login);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session jika berhasil login
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['prodi'] = $user['prodi'] ?? '';
            $_SESSION['nim'] = $user['nim'] ?? '';

            // Redirect ke dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Password salah
            $error_message = 'Password salah';
        }
    } else {
        // User tidak ditemukan
        $error_message = 'Email atau Username tidak ditemukan';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @layer utilities {
            .bg-custom-gradient {
                background: linear-gradient(to right, #d2dde8, #aec1d4, #86a4bf, #5e86aa, #376895);
            }
        }
    </style>
</head>
<body class="bg-custom-gradient">

    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 ">
            <form class="space-y-6" action="" method="POST">
                <h5 class="text-xl font-medium text-[#0f1c28]">Sign in to our platform</h5>

                <!-- Input Email atau Username -->
                <div>
                    <label for="login" class="block mb-2 text-sm font-medium text-gray-900">Your email or username</label>
                    <input type="text" name="login" id="login" class="bg-[#d2dde8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@gmail.com" required />
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-[#d2dde8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>

                <!-- Tampilkan error message jika ada -->
                <?php if (!empty($error_message)): ?>
                    <p class="text-red-500 text-sm"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <!-- Tombol Login -->
                <button type="submit" class="w-full text-white bg-[#1b3248] !important hover:bg-[#0f1c28] focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login to your account</button>
                
                <!-- Link ke registrasi -->
                <div class="text-sm font-medium text-gray-500">
                    Login as student <a href="loginMhs.php" class="text-[#1b3248] hover:underline">here</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
