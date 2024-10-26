<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$currentUser = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Informasi Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-sky-950">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-sky-700 to-teal-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-sky-50">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Dashboard
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full bg-sky-500 p-2" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 24 24'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/%3E%3C/svg%3E" alt="User">
                        <span class="text-sky-50"><?= htmlspecialchars($currentUser['username']) ?></span>
                    </div>
                    <a href="CRUD/logout.php" class="text-teal-100 hover:text-teal-50 font-medium flex items-center">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-sky-500 to-teal-600 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="fas fa-user-circle mr-2"></i>
                Selamat Datang, <?= htmlspecialchars($currentUser['username']) ?>!
            </h2>
            <p class="text-sky-100 mt-1">
                <?= $currentUser['role'] === 'admin' ? 'Administrator Panel' : 'Student Dashboard' ?>
            </p>
        </div>

        <?php if ($currentUser['role'] === 'admin'): ?>
            <!-- Admin Section -->
            <div class="bg-gradient-to-r from-sky-700 to-teal-600 rounded-lg shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-user-plus mr-2 text-sky-100"></i>
                    Input Mahasiswa Baru
                </h3>
                <form action="CRUD/inputData.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama" class="text-white font-medium flex items-center">
                            <i class="fas fa-user mr-2 text-sky-100"></i>
                            Nama
                        </label>
                        <input type="text" name="nama" class="w-full px-4 py-2 border border-sky-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all" placeholder="Masukan nama" required>
                    </div>
                    <div class="space-y-2">
                        <label for="nim" class="text-white font-medium flex items-center">
                            <i class="fas fa-id-card mr-2 text-sky-100"></i>
                            NIM
                        </label>
                        <input type="text" name="nim" class="w-full px-4 py-2 border border-sky-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all" placeholder="Masukkan NIM" required>
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label for="prodi" class="text-white font-medium flex items-center">
                            <i class="fas fa-graduation-cap mr-2 text-sky-100"></i>
                            Program Studi
                        </label>
                        <select name="prodi" class="w-full px-4 py-2 border border-sky-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all placeholder-gray-500" required>
                            <option value="" disabled selected>Pilih Program Studi</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                            <option value="Kimia">Kimia</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Aktuaria">Aktuaria</option>
                            <option value="Biologi">Biologi</option>
                            <option value="Geofisika">Geofisika</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-300 flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Tambah Mahasiswa
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <!-- Student List -->
        <div class="bg-gradient-to-r from-sky-700 to-teal-600 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                <i class="fas fa-users mr-2 text-sky-100"></i>
                Daftar Mahasiswa
            </h3>
            <div class="h-80 overflow-y-auto">
                <table class="min-w-full divide-y divide-sky-200">
                    <thead class="bg-sky-500 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Prodi</th>
                            <?php if ($currentUser['role'] === 'admin'): ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-200">
                        <?php
                        include 'conn.php';

                        $query = 'SELECT * FROM mahasiswa';
                        $user = $conn->query($query);

                        while ($row = $user->fetch_assoc()) {
                            $nama = $row['nama'];
                            $nim = $row['nim'];
                            $prodi = $row['prodi'];
                            $id = $row['id'];
                        ?>
                            <tr class="hover:bg-sky-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-sky-100 flex items-center justify-center mr-3">
                                            <span class="text-sky-500 font-medium"><?= strtoupper(substr($nama, 0, 1)) ?></span>
                                        </div>
                                        <div class="text-sm font-medium text-gradient-to-r from-sky-700 to-teal-600"><?= $nama ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-900"><?= $nim ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-100 text-sky-800">
                                        <?= $prodi ?>
                                    </span>
                                </td>
                                <?php if ($currentUser['role'] === 'admin'): ?>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="CRUD/edit.php?id=<?= $id ?>" class="text-blue-500 hover:text-blue-600 mr-4">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <a href="CRUD/hapusData.php?id=<?= $id ?>" class="text-teal-500 hover:text-teal-600"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash-alt mr-1"></i>
                                            Hapus
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-sky-700 to-teal-600 shadow-lg mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4">
            <p class="text-center text-white text-sm">
                © <?= date('Y') ?> Yusra. All rights reserved.
            </p>
        </div>
    </footer>
</body>

</html>