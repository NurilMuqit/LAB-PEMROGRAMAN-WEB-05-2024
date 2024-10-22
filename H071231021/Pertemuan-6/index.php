<?php
session_start();

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ],
    
    [
        'email' => 'miraicantik@gmail.com',
        'username' => 'miraikawaii',
        'name' => 'Mirai Kuriyama',
        'password' => password_hash('mirai123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Spirit World Knight',
    ],

    [
        'email' => 'ciccakcantikdidinding@gmail.com',
        'username' => 'ciccak',
        'name' => 'Asfira Rezky Syam',
        'password' => password_hash('chica123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Adab dan Humaniora',
        'batch' => '2024',
    ]
];


if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['email_username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if (($user['email'] === $input || $user['username'] === $input) && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit();
        }
    }

    $error = 'Email/Username or Password is incorrect';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e0e0e0] text-white flex flex-col gap-4 items-center justify-center h-screen">
    <h2 class="animate-bounce text-5xl h-14 mb-9 text-center text-black">𝓛𝓸𝓰𝓲𝓷 𝓓𝓾𝓵𝓾 𝓑𝓪𝓷𝓰 👅</h2>
    <div class="bg-[#e0e0e0] p-8 rounded-xl w-full max-w-lg shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
        <?php if ($error): ?>
            <p class="text-red-500 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label for="email_username" class="block text-lg mb-2 text-gray-600">Email or Username</label>
                <input placeholder="Masukin bg" type="text" id="email_username" name="email_username" required class="w-full px-4 py-2 bg-[#e0e0e0] border-none rounded-lg shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff] focus:outline-none focus:ring-2 focus:ring-gray-400 text-gray-700">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-lg mb-2 text-gray-600">Password</label>
                <input placeholder="Coba tebak :v" type="password" id="password" name="password" required class="w-full px-4 py-2 bg-[#e0e0e0] border-none mb-4 rounded-lg shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff] focus:outline-none focus:ring-2 focus:ring-gray-400 text-gray-700">
            </div>
            <button type="submit" class="w-full bg-[#e0e0e0] text-black font-semibold py-2 rounded-lg shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff] transition duration-300 ease-in-out active:translate-y-1">Login</button>
        </form>
    </div>

</body>
</html>
