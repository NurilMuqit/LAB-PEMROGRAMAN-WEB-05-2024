<?php
session_start(); 


if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit;
}

$nama = $_SESSION['name'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$gender = $_SESSION['gender'];
$faculty = $_SESSION['faculty'];
$batch = $_SESSION['batch'];

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
        'email' => 'lifsa@gmail.com',
        'username' => 'lifsa',
        'name' => 'lifsa',
        'password' => password_hash('lifsa123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2023',
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to left, #547896, #daeeff);
            background-size: cover;
            background-position: center;
            padding: 20px;
            min-height: 100vh; /* Menjamin tinggi body penuh */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color:#173c5b;
        }

        .btn-logout {
            font-weight:bold;
            background-color: #173c5b;
            color: #b1cde3;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-logout:hover {
            background-color: #718799;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        p {
            font-size:20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <?php if ($email == 'admin@gmail.com' || $username == 'adminxxx'): ?>
            <h1>Welcome, <?php echo $nama; ?></h1>
            <p><strong>Email: </strong> <?php echo $email; ?></p>
            <p><strong>Username: </strong> <?php echo $username; ?></p>
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
            <h2 class="mt-5">All User</h2>
            <table class="table table-primary table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php if($user['username'] != 'adminxxx' && $user['email'] != 'admin@gmail.com'): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['gender'] ?? 'N/A'; ?></td>
                            <td><?php echo $user['faculty'] ?? 'N/A'; ?></td>
                            <td><?php echo $user['batch'] ?? 'N/A'; ?></td>
                        </tr>
                        <?php endif; ?>
                        
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h1>Welcome, <?php echo $nama; ?></h1>
            <p><strong>Email: </strong> <?php echo $email; ?></p>
            <p><strong>Username: </strong> <?php echo $username; ?></p>
            <p><strong>Gender: </strong> <?php echo $gender; ?></p>
            <p><strong>Faculty: </strong> <?php echo $faculty; ?></p>
            <p><strong>Batch: </strong> <?php echo $batch; ?></p>
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
                    
        <?php endif; ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
