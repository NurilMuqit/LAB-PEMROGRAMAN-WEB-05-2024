<?php 
include '../conn.php';
$id = $_GET['id'];

$query = "SELECT * FROM mahasiswa WHERE id = $id";
$user = $conn->query($query);

$result = $user->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-teal-500 via-sky-500 to-lime-500 min-h-screen">
    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10 bg-white/90 backdrop-blur-sm p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Data Mahasiswa</h2>
        <form action="editData.php" method="POST" class="space-y-4">
            <div>
                <label for="id" class="flex items-center text-sky-900 hover:text-gray-800 py-2">ID</label>
                <input type="text" name="id" value="<?= $result['id'] ?>" class="w-full pl-4 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white" readonly>
            </div>
            <div>
                <label for="nama" class="flex items-center text-sky-900 hover:text-gray-800 py-2">Nama</label>
                <input type="text" name="nama" value="<?= $result['nama'] ?>" class="w-full pl-4 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white" required>
            </div>
            <div>
                <label for="nim" class="flex items-center text-sky-900 hover:text-gray-800 py-2">NIM</label>
                <input type="text" name="nim" value="<?= $result['nim'] ?>" class="w-full pl-4 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white" required>
            </div>
            <div>
                <label for="prodi" class="flex items-center text-sky-900 hover:text-gray-800 py-2">Program Studi</label>
                <select name="prodi" class="w-full pl-4 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white" required>
                    <option value="Informatika" <?= $result['prodi'] == 'Informatika' ? 'selected' : '' ?>>Informatika</option>
                    <option value="Sistem Informasi" <?= $result['prodi'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                    <option value="Teknik Komputer" <?= $result['prodi'] == 'Teknik Komputer' ? 'selected' : '' ?>>Teknik Komputer</option>
                    <option value="Teknik Elektro" <?= $result['prodi'] == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                    <option value="Kimia" <?= $result['prodi'] == 'Kimia' ? 'selected' : '' ?>>Kimia</option>
                    <option value="Matematika" <?= $result['prodi'] == 'Matematika' ? 'selected' : '' ?>>Matematika</option>
                    <option value="Fisika" <?= $result['prodi'] == 'Fisika' ? 'selected' : '' ?>>Fisika</option>
                    <option value="Biologi" <?= $result['prodi'] == 'Biologi' ? 'selected' : '' ?>>Biologi</option>
                    <option value="Aktuaria" <?= $result['prodi'] == 'Aktuaria' ? 'selected' : '' ?>>Aktuaria</option>
                    <option value="Geofisika" <?= $result['prodi'] == 'Geofisika' ? 'selected' : '' ?>>Geofisika</option>
                </select>
            <button type="submit" class="bg-blue-500 text-white px-4 mt-3 py-2 rounded-md hover:bg-blue-600">Save</button>
        </form>
    </div>
</body>
</html>
