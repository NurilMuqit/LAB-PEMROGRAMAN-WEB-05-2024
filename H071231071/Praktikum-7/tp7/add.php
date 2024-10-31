<?php
include 'config\conn.php';
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $addNama = $_POST['addNama'];
                                $addNim = $_POST['addNim'];
                                $addProdi = $_POST['addProdi'];

                                // Cek apakah NIM sudah ada
                                $check = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
                                $check->bind_param('s', $addNim);
                                $check->execute();
                                $result = $check->get_result();

                                if ($result->num_rows > 0) {
                                    // Jika NIM sudah ada, tampilkan pesan error
                                    echo "<script>alert('NIM sudah ada');</script>";
                                } else {
                                    // Jika NIM belum ada, masukkan data ke database
                                    $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
                                    $stmt->bind_param('sss', $addNama, $addNim, $addProdi);

                                    if ($stmt->execute()) {
                                        // Berhasil insert data, reload halaman
                                        header('Location: dashboard.php');
                                        exit;
                                    } else {
                                        // Error saat insert data
                                        echo "Error: " . $stmt->error;
                                    }
                                }

                                // Tutup koneksi database
                                // $stmt->close();
                                // $conn->close();
                            }
                            ?>