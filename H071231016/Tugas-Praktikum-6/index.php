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
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
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
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
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
        'email' => 'athifaaah@gmail.com',
        'username' => 'athifahaja',
        'name' => 'Athifah Nur Rahman MD.',
        'password' => password_hash('12345678', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Mathematics and Natural Science',
        'batch' => '2023',
        'NIM' => 'H071231016',
        'photo_url' => ''
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
];

$error = '';
$login_success= false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input_email_or_username = $_POST['input_email_or_username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if (($user['email'] == $input_email_or_username || $user['username'] == $input_email_or_username ) 
            && password_verify($password, $user['password'])){
            $_SESSION['user'] = $user;
            
            if($_SESSION['user']['name'] === 'Admin'){
              $_SESSION['users'] = $users;
            }
            header("Location: dashboard.php");
            exit;
          }
    }
    $error = "Invalid login credential";
}

if(isset($_SESSION['user'])){
  header("Location:dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-200 flex justify-center items-center h-screen">
  <div class="flex max-w-4xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden">
    <!-- Bagian Gambar -->
    <div class="w-1/2 bg-white justify-center items-center p-9">
      <img src="Login1.png" alt="login" class="w-full h-full">
    </div>
    
    <!-- Bagian Form Login -->
    <div class="w-1/2 bg-gradient-to-r from-yellow-200 via-orange-200 to-red-300 p-8">
      <h2 class="text-3xl font-bold mb-5 text-red-950">LOGIN</h2>

      <!-- Form -->
      <form action="#" method="POST" class="space-y-6">
      <?php if ($error): ?>
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $error; ?></span>
          </div>
      <?php endif; ?>
        <div>
          <label for="input_email_or_username" class="block text-red-950 text-sm font-bold mb-2">Email or Username:</label>
          <input type="text" id="input_email_or_username" name="input_email_or_username" placeholder="cth:gmail@gmail.com" class="w-full px-3 py-2 border text-red-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
          <label for="password" class="block text-red-950 text-sm font-bold mb-2">Password:</label>
          <input type="password" id="password" name="password" placeholder="password" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
          <button type="submit" class="w-full bg-white text-red-950 py-2 px-4 rounded-md font-semibold hover:bg-yellow-100">Submit</button>
        </div>
      </form>

      <!-- Register Link -->
      <p class="mt-4 text-sm text-red-950">
        Don't have an account? <a href="#" class="text-blue-600 hover:underline">Register Here.</a>
      </p>

    </div>
  </div>
</body>
</html>

