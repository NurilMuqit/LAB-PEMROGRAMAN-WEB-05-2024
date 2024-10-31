<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['role'])){
    header('Location:login.php');
    exit;
}

$success = "";
$error = "";
$duplicate_nim_error = "";
$role = $_SESSION['role'];
$user_nim_input = isset($_SESSION['nim']) ? $_SESSION['nim'] : null;

//inisialisasi variabel untuk form edit
$edit_mode = false;
$edit_data = [];

//handle EDIT data (hanya untuk admin)
if ($role == 'admin' && isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $edit_query = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $edit_query->bind_param('i', $id);
    $edit_query->execute();
    $result = $edit_query->get_result();
    $edit_data = $result->fetch_assoc();
}

//handle UPDATE data (hanya untuk admin)
if ($role == 'admin' && isset($_POST['update'])){
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $role = $_POST['role'];

    if (strlen($nim) > 10) {
        $error = "NIM tidak boleh lebih dari 10 karakter!";
    } else {
         //cek duplikasi nim kecuali untuk data yang sedang diedit
        $check_duplicate_nim = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ? AND id != ?");
        $check_duplicate_nim->bind_param("si", $nim, $id);
        $check_duplicate_nim->execute();
        $result = $check_duplicate_nim->get_result();

        if ($result->num_rows > 0){
            $duplicate_nim_error = "NIM telah ada!";
            exit;
        } else {
            $update_query = $conn->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ?, role=? WHERE id = ?");
            $update_query->bind_param('ssssi', $nama, $nim, $prodi, $role, $id);
            if ($update_query->execute()){
                $success = "Data berhasil diperbaharui";
                header("Location: index.php?success=" . urlencode($success));
                exit;
            } else {
                $error = "Terjadi kesalahan saat memperbaharui data!";
            }
        }
    }
}

//handle ADD data mahasiswa (hanya utk admin)
if ($role == 'admin' && isset($_POST['tambah'])) {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $prodi = trim($_POST['prodi']);
    $role = trim($_POST['role']);

    //validasi input
    if (empty($nim) || empty($nama) || empty($prodi)  || empty($role)) {
        $error = "Semua kolom harus diisi!";
    } else {
        $checkQueryAddData = $conn->prepare("SELECT * FROM mahasiswa WHERE nim =?");
        $checkQueryAddData->bind_param('s', $nim);
        $checkQueryAddData->execute();
        $checkResultAddData = $checkQueryAddData->get_result();

        if ($checkResultAddData->num_rows > 0){
            $error = "NIM sudah terdaftar!";
            // header("Location: index.php?duplicate_nim_error=". urlencode($error));
            // exit;
        } else {
            //ini bagian kalau nim belum ada terdaftar
            $insertQueryAddData = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi, role) VALUES (?, ?, ?, ?)");
            $insertQueryAddData->bind_param('ssss', $nama, $nim, $prodi, $role);

            if ($insertQueryAddData->execute()) {
                $success = "Data mahasiswa berhasil ditambahkan!";
                header("Location: index.php?success=" . urlencode($success));
                exit;
            } else {
                $error = "Terjadi kesalahan saat menambahkan data!";
            }
        }
    }
}

// Handle DELETE data mahasiswa (hanya utk admin)
if ($role == 'admin' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Cek peran mahasiswa yang ingin dihapus
    $check_query = $conn->prepare("SELECT role FROM mahasiswa WHERE id = ?");
    $check_query->bind_param('i', $id);
    $check_query->execute();
    $check_result = $check_query->get_result();
    
    if ($check_result->num_rows > 0) {
        $check_row = $check_result->fetch_assoc();

        // Jika role adalah 'admin', tampilkan pesan error
        if ($check_row['role'] === 'admin') {
            $error = "Pengguna dengan role admin tidak dapat dihapus!";
        } else {
            // Jika bukan admin, lakukan penghapusan
            $delete_query = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
            $delete_query->bind_param('i', $id);

            if ($delete_query->execute()) {
                $success = "Data berhasil dihapus!";
                header("Location: index.php?success=" . urlencode($success));
                exit;
            } else {
                $error = "Terjadi kesalahan saat menghapus data!";
            }
        }
    } else {
        $error = "Data tidak ditemukan!";
    }
}



// Menampilkan data mahasiswa berdasarkan role-nya
if ($role == 'admin') {
    $result = $conn->query("SELECT * FROM mahasiswa");
} else {
    // Mahasiswa dapat melihat daftar mahasiswa lain
    $query = "SELECT * FROM mahasiswa WHERE role != 'admin'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
}

if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="indexstyle.css">

</head>

<body>
    <div class="container mx-auto mt-5 px-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">
                <?= $role == 'admin' ? 'Data Mahasiswa' : 'Data Mahasiswa' ?>
            </h2>
            <span class="text-gray-600" id="Role">Role: <?= ucfirst($role) ?></span>
        </div>

        <!-- Tampilkan pesan -->
        <?php if ($success) { ?>
            <p class="text-green-500 mb-4"><?= $success; ?></p>
        <?php } ?>
        <?php if ($error) { ?>
            <p class="text-red-500 mb-4"><?= $error; ?></p>
        <?php } ?>
        <?php if ($duplicate_nim_error) { ?>
            <p class="text-yellow-500 mb-4"><?= $duplicate_nim_error; ?></p>
        <?php } ?>

        <li class="nav-item">
            <button>
                <a class="nav-link" href="login.php">
                <i class="fas fa-sign-out-alt me-1"></i>Logout</a>
            </button>
        </li>

        <?php if ($role == 'admin') { ?>
            <!-- Form Tambah/Edit Data Mahasiswa (Only show for admin) -->
            <form method="POST" action="" class="bg-white p-4 rounded shadow-md mb-4">
                <?php if ($edit_mode) { ?>
                    <h3 class="text-lg font-semibold mb-3">Edit Data Mahasiswa</h3>
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                <?php } else { ?>
                    <h3 class="text-lg font-semibold mb-3">Tambah Data Mahasiswa</h3>
                <?php } ?>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Nama:</label>
                        <input type="text" name="nama" value="<?= $edit_mode ? $edit_data['nama'] : '' ?>"
                            class="border p-2 w-full rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">NIM:</label>
                        <input type="text" name="nim" value="<?= $edit_mode ? $edit_data['nim'] : '' ?>"
                            class="border p-2 w-full rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Program Studi:</label>
                        <input type="text" name="prodi" value="<?= $edit_mode ? $edit_data['prodi'] : '' ?>"
                            class="border p-2 w-full rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Role:</label>
                        <select name="role" class="border p-2 w-full rounded" required>
                            <option value="mahasiswa" <?= $edit_mode && $edit_data['role'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                        </select>
                    </div>

                </div>
                <div class="mt-4">
                    <?php if ($edit_mode) { ?>
                        <button type="submit" name="update"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Update Data
                        </button>
                        <a href="index.php" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Batal
                        </a>
                    <?php } else { ?>
                        <button type="submit" name="tambah" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Tambah Data
                        </button>
                    <?php } ?>
                </div>
            </form>
        <?php } ?>

        <table class="min-w-full bg-white shadow-md rounded" id="table-info">
            <thead>
                <tr>
                    <th class="py-3 px-4 bg-gray-200 text-left">Nama</th>
                    <th class="py-3 px-4 bg-gray-200 text-left">NIM</th>
                    <th class="py-3 px-4 bg-gray-200 text-left">Program Studi</th>
                    <?php if ($role == 'admin') { ?>
                        <th class="py-2 px-4 bg-gray-200 text-left">Role</th>
                        <th class="py-2 px-4 bg-gray-200 text-left">Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $row['nama']; ?></td>
                        <td class="border px-4 py-2"><?= $row['nim']; ?></td>
                        <td class="border px-4 py-2"><?= $row['prodi']; ?></td>
                        <td class="border px-4 py-2"><?= $row['role']; ?></td>
                        <?php if ($role == 'admin') { ?>
                            <td class="border px-4 py-2">
                                <a href="index.php?edit=<?= $row['id']; ?>" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <a href="index.php?delete=<?= $row['id']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-red-500 hover:text-red-700">Hapus</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
