<?php
session_start();


if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username']) {
        $usernameInput = $_POST['username'];
        $passwordInput = $_POST['password'];
        $loggedIn = false;

    } else if($_POST['email']) {
        $usernameInput = $_POST['email'];
        $passwordInput = $_POST['password'];
        $loggedIn = false;
    }

    foreach ($users as $user) {
        if (($user['username'] === $usernameInput || $user['email'] === $usernameInput) && 
            password_verify($passwordInput, $user['password'])) {
            // Set session jika berhasil login
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['gender'] = $user['gender'] ?? '';
            $_SESSION['faculty'] = $user['faculty'] ?? '';
            $_SESSION['batch'] = $user['batch'] ?? '';
            $loggedIn = true; // Set status login
            header("Location: dashboard.php"); // Arahkan ke dashboard
            exit;
        }
    }

    if (!$loggedIn) {
        $error_message = 'Password atau Username Salah';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('p3.png');
            background-size: cover;
            background-position: center;
        }
        .btn-login {
            font-weight:bold;
            background-color: #b1cde3;
            color: #173c5b;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-login:hover {
            background-color: #718799;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .card {
            width: 500px;
            height: 400px;
            background-color: rgba(23, 60, 91, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
        }

        .login-title {
            font-weight:bolde;
            color:white;
            font-size: 70px; 
            margin-top: 45px; 
        }

        input{
            color: #173c5b;
        }

        .form-input {
            color: #173c5b;
            width: 100%;
            margin-bottom: 5px;
        }

    </style>
</head>

<body style="background-color: #e6e6e6;">
<div class="container vh-100 d-flex justify-content-center align-items-center"> 
        <div class="card shadow"> 
            <div class="text-center login-title">
                <h4>Login</h4>
            </div>
            <div class="card-body w-100 form-input">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?= $error_message; ?></div>
                <?php endif; ?>
                <form action="" method="POST" class="text-white w-100">
                    <div class="form-group">
                        <label for="username">Email or Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Email or Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-block btn-login">Login</button> <br><br>
                    <p class="text-center">Don't have an account? Regist <a href="" style="color: #b1cde3"><u><strong>here</strong></u></a></p>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
