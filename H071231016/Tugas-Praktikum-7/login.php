<?php
include 'config/config.php';
session_start();

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query untuk mencari user berdasarkan username
    $query = $conn->prepare("SELECT * FROM mahasiswa WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if ($password === $user['password']) {
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Password salah!';
        }
    } else {
        $error = 'Username tidak ditemukan!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('image/rektorat.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="flex justify-center items-center h-screen p-8">
    <div class="bg-red-900 bg-opacity-50 mx-8 p-8 shadow-2xl rounded-lg max-w-md w-full">
        <h2 class="text-white text-3xl font-bold text-center mb-6">Welcome</h2>
        
        <?php if ($error): ?>
            <div class="text-red-500 text-center mb-4"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-4">
                <input 
                    type="text" 
                    name="username"
                    placeholder="Username" 
                    class="w-full p-3 bg-white text-red-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    required
                >
            </div>
            <div class="mb-4">
                <input 
                    type="password" 
                    name="password"
                    placeholder="Password" 
                    class="w-full p-3 bg-white text-red-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <button type="submit" name="login" class="w-full bg-yellow-500 text-red-800 font-bold py-3 rounded-lg hover:bg-yellow-400 transition duration-300">
                Login
            </button>
        </form>

        <p class="mt-4 text-sm text-white text-center">
            Don't have an account? <a href="" class="text-yellow-200 hover:underline">Register Here</a>.
        </p>
    </div>
</body>
</html>
