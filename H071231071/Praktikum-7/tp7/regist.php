<?php
include './config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah NIM atau email sudah ada
    $check = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
    $check->bind_param('s', $nim);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Jika NIM atau email sudah ada
        echo "<script>alert('NIM sudah terdaftar!'); window.location.href = 'regist.php';</script>";
    } else {
        // Insert data jika NIM dan email belum terdaftar
        $in = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?,?,?)");
        $in->bind_param('sss', $nama, $nim, $prodi);

        if ($in->execute()) {
            header('Location: loginMhs.php');
        } else {
            echo "Error: " . $in->error;
        }
    }

    // Tutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <!-- Container Flex untuk posisi tengah -->
    <div class="flex justify-center items-center min-h-screen">
        <!-- Menambahkan class responsif -->
        <div class="w-full max-w-full sm:max-w-xl md:max-w-2xl p-6 bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8">
            <form class="space-y-6" action="" method="POST">
                <h5 class="text-xl font-medium text-[#0f1c28]">Sign Up to our platform</h5>

                <!-- Grid Layout untuk NIM dan Prodi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nim" class="block mb-2 text-sm font-medium text-gray-900">NIM</label>
                        <input type="text" name="nim" id="nim" class="bg-[#d2dde8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="NIM Anda" required />
                    </div>
                    <div>
                        <label for="prodi" class="block mb-2 text-sm font-medium text-gray-900">Prodi</label>
                        <input type="text" name="prodi" id="prodi" class="bg-[#d2dde8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Prodi Anda" required />
                    </div>
                </div>

                <!-- Input untuk Nama -->
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="nama" id="nama" class="bg-[#d2dde8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Anda" required />
                </div>


                <!-- Tombol login dengan warna custom -->
                <button type="submit" class="w-full text-white bg-[#1b3248] hover:bg-[#0f1c28] focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Regist your account</button>
                <div class="text-sm font-medium text-gray-500">
                    Already Have An Account? <a href="http://localhost/tp7/login.php" class="text-[#1b3248] hover:underline">Sign In Here</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
</body>
</html>
