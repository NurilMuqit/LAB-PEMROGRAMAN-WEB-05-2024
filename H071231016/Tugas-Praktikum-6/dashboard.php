<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location:index.php");
    exit;
}

$user = $_SESSION['user'];
if ($_SESSION['user']['name'] === 'Admin'){
    $users = $_SESSION['users'];
}

if(isset($_GET['logout'])){
    session_destroy();
    header('Location:Index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-yellow-200 via-orange-200 to-red-300 flex justify-center items-center h-screen">
    <div class="flex items-center w-4/5 h-3/4 bg-white-30% shadow-2xl rounded-lg overflow-hidden">
        <div class="relative overflow-x-auto p-12 rounded-lg flex flex-col justify-between w-full mt-4">
            <div>
                <h1 class="text-5xl font-bold text-gray-800">WELCOME, <span class="text-red-900"><?php echo $_SESSION['user']['name']; ?></span>!</h1>
                <p class="mt-10 font-bold">Email: <span class="text-red-900"> <?php echo $_SESSION['user']['email']; ?></span></p>
                <p class="font-bold">Username: <span class="text-red-900"><?php echo $_SESSION['user']['username']; ?></span></p>
                <?php if ($_SESSION['user']['name'] != 'Admin'): ?>
                    <p>Gender:<span class="text-red-900"> <?php echo $_SESSION['user']['gender']; ?></span></p>
                    <p>Faculty: <span class="text-red-900"><?php echo $_SESSION['user']['faculty']; ?></span></p>
                    <p>Batch: <span class="text-red-900"><?php echo $_SESSION['user']['batch']; ?></span></p>
                <?php else: ?>
                    <h2 class="font-bold">All Users</h2>
                    <div class="max-h-60 overflow-y-auto" tyle="scrollbar-width: none; overflow-y: scroll;">
                    <style>
                        /* Menyembunyikan scrollbar di browser berbasis WebKit seperti Chrome dan Safari */
                        div::-webkit-scrollbar {
                            display: none;
                        }
                    </style>
                        <table class="min-w-full border-collapse border border-gray-200" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="border-2 border-orange-800 text-red-950">Name</th>
                                    <th class="border-2 border-orange-800 text-red-950">Email</th>
                                    <th class="border-2 border-orange-800 text-red-950">Username</th>
                                    <th class="border-2 border-orange-800 text-red-950">Gender</th>
                                    <th class="border-2 border-orange-800 text-red-950">Faculty</th>
                                    <th class="border-2 border-orange-800 text-red-950">Batch</th>
                                </tr>
                            </thead>
                            <tbody class=" divide-y divide-gray-200">
                                <?php foreach ($users as $user): ?>
                                    <?php if ($user['name'] != 'Admin'): ?>
                                        <tr>
                                            <td class=" border-b-2 border-l-2 border-orange-800 text-red-950"><span class="text-red-900"><?php echo $user['name']; ?></span></td>
                                            <td class=" border-b-2 border-x-2 border-orange-800 text-red-950"><span class="text-red-900"><?php echo $user['email']; ?></span></td>
                                            <td class=" border-b-2 border-r-2 border-orange-800 text-red-950"><span class="text-red-900"><?php echo $user['username']; ?></span></td>
                                            <td class=" border-b-2 border-r-2 border-orange-800 text-red-950"><span class="text-red-900"><?php echo $user['gender']; ?></span></td>
                                            <td class=" border-b-2 border-r-2 border-orange-800 text-red-950"><span class="text-red-900"><?php echo $user['faculty']; ?></span></td>
                                            <td class=" border-b-2 border-r-2 border-orange-800 text-red-950"><span class="text-red-900"><?php echo $user['batch']; ?></span></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <br>
                <button class="bg-red-800 hover:bg-red-400 text-white font-bold py-2 px-4 rounded shadow-lg hover:shadow-2xl">
                    <a href="?logout">Logout</a>
                </button>
                
            </div>
        </div>

        <div class="p-12">
            <?php
            if ($_SESSION['user']['name'] != "Admin") {
                echo '<img src="img2.png" alt="img2" class="w-84"> ';
            } ?>
            
        </div>
    </div>
</body>
</html>

