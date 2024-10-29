<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['nim']))  {
    header("Location: login.php");
    exit;
}

include 'config/conn.php'; // Koneksi ke database

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$nim = $_SESSION['nim'];
$prodi = $_SESSION['prodi'];

// Cek apakah user adalah admin
$is_admin = ($_SESSION['username'] == 'adminxxx' || $_SESSION['email'] == 'admin@gmail.com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
<body class="bg-custom-gradient min-h-screen flex flex-col items-center justify-center">

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl w-full">
            
            <?php if ($is_admin): ?>
                <h1 class="text-3xl font-bold text-[#0f1c28] mb-4">Welcome, <?php echo $_SESSION['nama']; ?></h1>
                <p class="text-gray-600"><strong>Email: </strong> <?php echo $_SESSION['email']; ?></p>
                <p class="text-gray-600"><strong>Username: </strong> <?php echo $_SESSION['username']; ?></p>
    
                <form action="logout.php" method="post" class="mt-6">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">Logout</button>
                </form>
                <h2 class="text-xl font-semibold mt-8 text-[#0f1c28]">All Users</h2>
                <div class="justify-items-start">
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-cyan-950 hover:bg-cyan-1000 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                    Add User
                    </button>

                    <div class="relative ml-5">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1 flex justify-between items-center">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-slate-900 focus:border-slate-900" placeholder="Enter NIM">
                        <button onclick="searchAndScroll()" class="ml-3 mb-2 mt-2 text-white bg-slate-700 hover:bg-slate-800 px-4 py-2 rounded">Search</button>
                    </div>
                    </div>
                    
                    
                </div>
                <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Create New Student
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>


                            <!-- Modal body -->
                            

                            <form class="p-4 md:p-5" method="post" action="add.php">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="addNama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                        <input type="text" name="addNama" id="addNama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type student name" required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="addNim" class="block mb-2 text-sm font-medium text-gray-900">NIM</label>
                                        <input type="text" name="addNim" id="addNim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type student NIM" required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="addProdi" class="block mb-2 text-sm font-medium text-gray-900">Prodi</label>
                                        <input type="text" name="addProdi" id="addProdi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Type student major" required="">
                                    </div>
                                </div>
                                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    ADD
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="overflow-x-auto mt-4">
                    <div class="max-h-64 overflow-y-auto">
                        <table class="min-w-full table-auto border-collapse bg-blue-50">
                            <thead class="bg-[#1b3248] text-white sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left">No</th>
                                    <th class="px-6 py-3 text-left">NIM</th>
                                    <th class="px-6 py-3 text-left">Nama</th>
                                    <th class="px-6 py-3 text-left">Prodi</th>
                                    <th class="px-6 py-3 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" >
                                <?php
                                $query = "SELECT * FROM mahasiswa WHERE (username != 'adminxxx' and email != 'admin@gmail.com') OR username IS NULL";
                                $result = $conn->query($query);
                                $number = 1;

                                while ($row = $result->fetch_assoc()) {
                                    $id2 = $row['id'];
                                    $nim2 = $row['nim'];
                                    ?>
                                    <tr id="student-<?= $nim2 ?>" class="bg-white hover:bg-gray-100">
                                        <td class="px-6 py-4"><?php echo $number++; ?></td>
                                        <td class="px-6 py-4"><?php echo $row['nim']; ?></td>
                                        <td class="px-6 py-4"><?php echo $row['nama']; ?></td>
                                        <td class="px-6 py-4"><?php echo $row['prodi']; ?></td>
                                        <td class="px-6 py-4">

                                        <!-- BUTTON EDIT DAN -->
                                        <button 
                                            name="editModal" 
                                            id="editModal-<?= $id2 ?>" 
                                            data-modal-target="edit-modal-<?= $id2 ?>" 
                                            data-modal-toggle="edit-modal-<?= $id2 ?>" 
                                            class="mr-4 font-medium text-slate-600 hover:underline">
                                            Edit
                                        </button>

                                        <button 
                                            name="deleteModal" 
                                            id="deleteModal-<?= $id2 ?>" 
                                            data-modal-target="delete-modal-<?= $id2 ?>" 
                                            data-modal-toggle="delete-modal-<?= $id2 ?>" 
                                            class="font-medium text-red-600 hover:underline">
                                            Delete
                                        </button>

                                        <!--  MODAL EDIT-->                                                     
                                        <div id="edit-modal-<?= $id2 ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                                                        <h3 class="text-lg font-semibold text-gray-900 ">
                                                            Edit Student Data
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-<?= $id2 ?>">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <form class="p-4 md:p-5" action="update.php" method="POST">
                                                        <input type="hidden" name="idEdit" value="<?= $id2 ?>">
                                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                                            <div class="col-span-2">
                                                                <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 ">NIM</label>
                                                                <input type="text" name="nim" id="nim" value="<?php echo $row['nim'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                                                                <input type="text" name="nama" id="nama" value="<?php echo $row['nama'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label for="prodi" class="block mb-2 text-sm font-medium text-gray-900 ">Study Program</label>
                                                                <input type="text" name="prodi" id="prodi" value="<?php echo $row['prodi'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">

                                                            </div>
                                                        </div>
                                                        <button name="saveEdit" type="submit" class="text-white inline-flex items-center bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                            Save Edit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- DELETE MODAL -->
                                        <div name="delete-modal-<?= $id2 ?>" id="delete-modal-<?= $id2 ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-modal-<?= $id2 ?>">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this student data?</h3>
                                                        <div class="flex justify-center space-x-2">
                                                            <form action="delete.php" method="POST">
                                                                <input type="hidden" name="idDelete" value="<?= $id2 ?>">
                                                                <button name="deleteFR" type="submit" id="delete" data-modal-hide="delete-modal-<?= $id2 ?>" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Yes, I'm sure
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="delete-modal-<?= $id2 ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-slate-900 focus:outline-none bg-slate-100 rounded-lg border border-slate-200 hover:bg-slate-900 hover:text-blue-100 focus:z-10 focus:ring-4 focus:ring-slate-100">No, cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>
                <h1 class="text-3xl font-bold text-[#0f1c28] mb-4">
                    Welcome, <?php echo explode(' ', $_SESSION['nama'])[0]; ?>
                </h1>
                <p class="text-gray-600"><strong>Nama: </strong> <?php echo $_SESSION['nama']; ?></p>
                <p class="text-gray-600"><strong>NIM: </strong> <?php echo $_SESSION['nim']; ?></p>
                <p class="text-gray-600"><strong>Prodi: </strong> <?php echo $_SESSION['prodi']; ?></p>
                <form action="logout.php" method="post" class="mt-6">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>


    <script>
        function searchAndScroll() {
            // Ambil nilai dari search bar
            var inputNIM = document.getElementById('table-search').value;
            
            // Cek apakah NIM diisi
            if (inputNIM) {
                // Temukan baris yang memiliki ID sesuai dengan NIM yang dimasukkan
                var studentRow = document.getElementById('student-' + inputNIM);
                
                if (studentRow) {
                    // Scroll ke elemen jika ditemukan
                    studentRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Highlight baris yang ditemukan (opsional)
                    studentRow.style.backgroundColor = '#d1d5db'; // Beri warna highlight sementara
                    setTimeout(function() {
                        studentRow.style.backgroundColor = ''; // Kembalikan warna semula setelah beberapa saat
                    }, 4000);
                } else {
                    alert('Student is not found.');
                }
            } else {
                alert('Enter NIM first.');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
