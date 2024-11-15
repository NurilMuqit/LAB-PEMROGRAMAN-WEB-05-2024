<?php
include "./config/config.php";

$error = "";
$success = "";

$nama = "";
$nim = "";
$prodi = "";
$fakultas = "";

$action = "";

if (isset($_GET["action"])) {
    $action = $_GET['action'];
}

if ($action == 'edit') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if (empty($data)) {  
        $error = "Data tidak ditemukan";
    } else {
        $nama = $data["nama"];
        $nim = $data["nim"];
        $prodi = $data["prodi"];
        $fakultas = $data["fakultas"];
    }
}

if (isset($_POST["save"])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];

    if ($nim && $nama && $prodi && $fakultas) {
        if ($action == 'edit') {
            $queryUpdate = "UPDATE students SET nim='$nim', nama='$nama', prodi='$prodi', fakultas='$fakultas' WHERE id='$id'";
            $resultUpdate = mysqli_query($conn, $queryUpdate);
            if ($resultUpdate) {
                $success = "Data berhasil diperbarui";
                header("Location: index.php?success=$success");
                exit();
            } else {
                $error = "Gagal memperbarui data.";
            }
        } else {
            $sql = "INSERT INTO students (nim, nama, prodi, fakultas) VALUES ('$nim', '$nama', '$prodi', '$fakultas')";
            try {
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    $success = "Data berhasil ditambahkan";
                    header("Location: index.php?success=$success");
                    exit();
                }
            } catch (mysqli_sql_exception $err) {
                $error = "Gagal menambahkan data.";
            }
        }
    } else {
        $error = "Semua data wajib diisi!";
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
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold bg-gray-100 -m-6 mb-4 px-4 py-2">Form Data</h2>

            <?php if ($error) { ?>
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    <?php echo $error ?>
                </div>
            <?php } ?>

            <form action="" method="post" class="space-y-4">
                <div class="grid grid-cols-12 items-center">
                    <label for="nim" class="col-span-2 font-medium">NIM</label>
                    <input type="text" id="nim" name="nim" value="<?php echo $nim ?>" class="col-span-10 mt-1 p-1.5 border rounded">
                </div>
                <div class="grid grid-cols-12 items-center">
                    <label for="nama" class="col-span-2 font-medium">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama ?>" class="col-span-10 mt-1 p-1.5 border rounded">
                </div>
                <div class="grid grid-cols-12 items-center">
                    <label for="prodi" class="col-span-2 font-medium">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" value="<?php echo $prodi ?>" class="col-span-10 mt-1 p-1.5 border rounded">
                </div>
                <div class="grid grid-cols-12 items-center">
                    <label for="fakultas" class="col-span-2 font-medium">Fakultas</label>
                    <select id="fakultas" name="fakultas" class="col-span-10 mt-1 p-1.5 border rounded">
                        <option value="">- Pilih fakultas -</option>
                        <option value="Kedokteran" <?php if ($fakultas == 'Kedokteran') echo "selected" ?>>Kedokteran</option>
                        <option value="MIPA" <?php if ($fakultas == 'MIPA') echo "selected" ?>>MIPA</option>
                        <option value="Teknik" <?php if ($fakultas == 'Teknik') echo "selected" ?>>Teknik</option>
                    </select>
                </div>
                <button type="submit" name="save" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.js"></script>
</body>

</html>
