<?php
include "./config/config.php";

$success = "";
$error = "";

if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

$action = "";

if (isset($_GET["action"])) {
    $action = $_GET['action'];
}

if ($action == 'delete') {
    $id = $_GET['id'];
    $queryDelete = "DELETE FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $queryDelete);
    if ($result) {
      $success = "data berhasil dihapus";
    } else {
      $error = "data gagal dihapus";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.css" />
</head>

<body class="bg-gray-50 min-h-screen mt-6">
    <div class="w-full max-w-4xl mx-auto p-4">
        <?php if ($error) { ?>
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <?php echo $error ?>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 3000); // Redirect setelah 3 detik
            </script>
        <?php } ?>

        <?php if ($success) { ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                <?php echo $success ?>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 5000); // Redirect setelah 5 detik
            </script>
        <?php } ?>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold">Data Mahasiswa</h2>
                <a href="form.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Tambah Data
                </a>
            </div>

            <table class="w-full table-auto border-collapse border border-gray-300 mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2 text-start">No</th>
                        <th class="border px-4 py-2 text-start">NIM</th>
                        <th class="border px-4 py-2 text-start">Nama</th>
                        <th class="border px-4 py-2 text-start">Program Studi</th>
                        <th class="border px-4 py-2 text-start">Fakultas</th>
                        <th class="border px-4 py-2 text-start">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $number = 1;
                    $sql = "SELECT * FROM students";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                    ?>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border px-4 py-2"><?= $number++ ?></td>
                            <td class="border px-4 py-2"><?= $row['nim'] ?></td>
                            <td class="border px-4 py-2"><?= $row['nama'] ?></td>
                            <td class="border px-4 py-2"><?= $row['prodi'] ?></td>
                            <td class="border px-4 py-2"><?= $row['fakultas'] ?></td>
                            <td class="border px-4 py-2">
                                <a href="form.php?action=edit&id=<?php echo $id ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a> |
                                <a href="index.php?action=delete&id=<?php echo $id ?>" class="bg-red-700 hover:bg-red-800 text-white px-3 py-1 rounded" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.js"></script>
</body>

</html>
