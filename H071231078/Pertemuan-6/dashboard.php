<?php
session_start();

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'role' => 'admin',
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
        'role' => 'student',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
        'role' => 'student',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
        'role' => 'student',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
        'role' => 'student',
    ],
    [
        'email' => 'raihan@gmail.com',
        'username' => 'raihan72',
        'name' => 'raihan',
        'password' => password_hash('raihan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
        'role' => 'student',
    ]
];

$role = $_SESSION["role"];

$loggedInUser = null;
foreach ($users as $user) {
    if ($user['role'] == $role) {
        $loggedInUser = $user;
        break;
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($role == "admin"): ?>
            <div class="row">
                <h1 class="mb-4">Welcome <?= $loggedInUser['role']; ?></h1>
                <div class="col-12 dashboard">
                    <div class="profile">
                        <div class="logo"><img src="profile.png" alt=""></div>
                        <div class="section-1">
                            <h4><?= $loggedInUser['name']; ?></h4>
                            <div class="section-1-1">
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['username']; ?></p>
                                    <p class="tittle">Username</p>
                                </div>
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['email']; ?></p>
                                    <p class="tittle">Email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4 users">
                        <div id="list-example" class="list-group">
                        <?php foreach ($users as $index => $user): ?>
                            <?php if ($user["role"] != 'admin'):?>
                            <a class="list-group-item list-group-item-action" href="#list-item-<?= $index + 1; ?>">
                                <?= $user["name"]; ?>
                            </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-8 users">
                        <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0" style="height: 400px; overflow-y: scroll;">
                        <?php foreach ($users as $index => $user): ?>
                            <?php if ($user["role"] != 'admin'):?>
                            <h4 id="list-item-<?= $index + 1; ?>">User: <?= $user["name"]; ?></h4>
                            <p>Username : <?= $user["username"]; ?><br>
                                Email : <?= $user["email"]; ?><br>
                                Gender: <?= $user["gender"]; ?><br>
                                Faculty: <?= $user["faculty"]; ?><br>
                                Batch: <?= $user["batch"]; ?><br>
                                Role: <?= $user["role"]; ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <form method="post" class="d-flex justify-content-end mt-3">
                    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                </form>
            </div>
        <?php else: ?>
            <div class="row">
            <h1 class="mb-4">Welcome <?= $loggedInUser['role']; ?></h1>
                <div class="col-12 dashboard">
                    <div class="profile">
                        <div class="logo"><img src="profile.png" alt=""></div>
                        <div class="section-1">
                            <h4><?= $loggedInUser['name']; ?></h4>
                            <div class="section-1-1">
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['username']; ?></p>
                                    <p class="tittle">Username</p>
                                </div>
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['email']; ?></p>
                                    <p class="tittle">Email</p>
                                </div>
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['gender']; ?></p>
                                    <p class="tittle">Gender</p>
                                </div>
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['faculty']; ?></p>
                                    <p class="tittle">Faculty</p>
                                </div>
                                <div class="section-2">
                                    <p class="title"><?= $loggedInUser['batch']; ?></p>
                                    <p class="tittle">Batch</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" class="d-flex justify-content-end mt-3">
                    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
