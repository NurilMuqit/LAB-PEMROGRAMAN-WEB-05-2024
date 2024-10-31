<?php
session_start();
if (isset($_SESSION['nim'])) {
    header("Location: dashboard.php");
    exit;
}
include 'config/conn.php';

// Cek jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];

    // Query untuk mencocokkan NIM
    $query = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
    $query->bind_param("s", $login);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['prodi'] = $user['prodi'];
        $_SESSION['nim'] = $user['nim'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['nim'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = 'NIM tidak ditemukan';
    }
}
?>

<!-- Bagian HTML -->
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
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
            <form class="space-y-6" action="" method="POST">
                <h5 class="text-xl font-medium text-[#0f1c28]">Sign in to our platform</h5>

                <div>
                    <label for="login" class="block mb-2 text-sm font-medium text-gray-900">NIM</label>
                    <input type="text" name="login" id="login" class="bg-[#d2dde8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="A0123456" required />
                </div>

                <!-- Tampilkan error message jika ada -->
                <?php if (!empty($error_message)): ?>
                    <p class="text-red-500 text-sm"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <button type="submit" class="w-full text-white bg-[#1b3248] hover:bg-[#0f1c28] focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login to your account</button>
                
                <div class="text-sm font-medium text-gray-500">
                    Not registered? <a href="regist.php" class="text-[#1b3248] hover:underline">Register here</a>
                </div>
                <div class="text-sm font-medium text-gray-500">
                    Are you admin? <a href="login.php" class="text-[#1b3248] hover:underline">Login here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
