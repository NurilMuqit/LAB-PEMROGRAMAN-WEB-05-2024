<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];
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
        'faculty' => 'Spirit World Knight'
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .fade-in-scale {
            animation: fadeInScale 1s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#e0e0e0] bg-cover text-white flex flex-col gap-4 items-center justify-center h-screen">

    <div class="container mx-auto p-8 fade-in-scale">
        <h2 class="text-5xl font-semibold mb-9 text-center text-gray-600">Welcome, <span class="text-blue-400"><?= htmlspecialchars($user['name']) ?></span>!</h2>

        <?php if ($user['username'] === 'adminxxx'): ?>
            <h3 class="text-xl text-gray-600 mb-4 fade-in-scale text-center mb-7">Admin Information:</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 fade-in-scale">
                <div class="bg-[e0e0e0] text-gray-600 p-4 rounded-md shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                    <p class="text-center text-xl"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                </div>
                <div class="bg-[e0e0e0] text-gray-600 p-4 rounded-md shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                    <p class="text-center text-xl"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                </div>
            </div>

            <div class="bg-[e0e0e0] text-gray-600 p-10 rounded-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff] fade-in-scale">
                <h3 class="text-xl mb-4">All Users:</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto bg-[e0e0e0] text-gray-400 border-gray-400 text-left">
                        <thead class="bg-[e0e0e0] text-gray-600 font-bold border-2 border-gray-400">
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Gender</th>
                                <th class="px-4 py-2">Faculty</th>
                                <th class="px-4 py-2">Batch</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <?php if ($u['username'] === 'adminxxx') continue?>
                                <tr class="bg-[e0e0e0] text-gray-500 border-b-2 border-gray-400 border-dashed">
                                    <td class="px-4 py-2"><?= htmlspecialchars($u['name']) ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($u['email']) ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($u['username']) ?></td>
                                    <td class="px-4 py-2"><?= isset($u['gender']) ? htmlspecialchars($u['gender']) : '-' ?></td>
                                    <td class="px-4 py-2"><?= isset($u['faculty']) ? htmlspecialchars($u['faculty']) : '-' ?></td>
                                    <td class="px-4 py-2"><?= isset($u['batch']) ? htmlspecialchars($u['batch']) : '-' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php else: ?>
                <h3 class="text-xl mb-4 text-center fade-in-scale text-gray-600">Your Information:</h3>
                <div class="flex justify-center items-center">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl fade-in-scale">
                        <div class="bg-[e0e0e0] p-4 rounded-xl text-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                            <p class="text-left p-4 mb-1 text-gray-600 font-bold">NAMA</p>
                            <p class="text-center rounded-md p-4 italic text-gray-600 shadow-[inset_5px_5px_13px_#cacaca,_inset_-5px_-5px_13px_#f6f6f6]"><?= htmlspecialchars($user['name']) ?></p>
                        </div>
                        <div class="bg-[e0e0e0] p-4 rounded-xl text-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                            <p class="text-left p-4 mb-1 text-gray-600 font-bold">EMAIL</p>
                            <p class="text-center rounded-md p-4 italic text-gray-600 shadow-[inset_5px_5px_13px_#cacaca,_inset_-5px_-5px_13px_#f6f6f6]"><?= htmlspecialchars($user['email']) ?></p>
                        </div>
                        <div class="bg-[e0e0e0] p-4 rounded-xl text-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                            <p class="text-left p-4 mb-1 text-gray-600 font-bold">USERNAME</p>
                            <p class="text-center rounded-md p-4 italic text-gray-600 shadow-[inset_5px_5px_13px_#cacaca,_inset_-5px_-5px_13px_#f6f6f6]"><?= htmlspecialchars($user['username']) ?></p>
                        </div>
                        <div class="bg-[e0e0e0] p-4 rounded-xl text-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                            <p class="text-left p-4 mb-1 text-gray-600 font-bold">GENDER</p>
                            <p class="text-center rounded-md p-4 italic text-gray-600 shadow-[inset_5px_5px_13px_#cacaca,_inset_-5px_-5px_13px_#f6f6f6]"><?= isset($user['gender']) ? htmlspecialchars($user['gender']) : '-' ?></p>
                        </div>
                        <div class="bg-[e0e0e0] p-4 rounded-xl text-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                            <p class="text-left p-4 mb-1 text-gray-600 font-bold">FAKULTAS</p>
                            <p class="text-center rounded-md p-4 italic text-gray-600 shadow-[inset_5px_5px_13px_#cacaca,_inset_-5px_-5px_13px_#f6f6f6]"><?= isset($user['faculty']) ? htmlspecialchars($user['faculty']) : '-' ?></p>
                        </div>
                        <div class="bg-[e0e0e0] p-4 rounded-xl text-xl shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff]">
                            <p class="text-left p-4 mb-1 text-gray-600 font-bold">BATCH</p>
                            <p class="text-center rounded-md p-4 italic text-gray-600 shadow-[inset_5px_5px_13px_#cacaca,_inset_-5px_-5px_13px_#f6f6f6]"><?= isset($user['batch']) ? htmlspecialchars($user['batch']) : '-' ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <a href="logout.php" class="w-48 bg-[#e0e0e0] text-gray-600 text-center text-xl font-semibold py-2 rounded-lg shadow-[8px_8px_16px_#bcbcbc,-8px_-8px_16px_#ffffff] transition duration-300 ease-in-out active:translate-y-1">Logout</a>

    </div>
</body>
</html>

