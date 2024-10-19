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
        'gender' => 'Females',
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);
  $login_success = false;

  foreach ($users as $user) {
      if ($user["email"] == $email && password_verify($password, $user["password"])) {
          $_SESSION["email"] = $email;
          $_SESSION["role"] = $user["role"];
          $login_success = true;
          header("Location: dashboard.php");
          exit();
      }
  }

  if (!$login_success) {
      echo "<script>var showToast = true;</script>";
  }
}

?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
  </head>
  <body>
    <div class="mainSection">
      <div class="row">
        <div class="section-1 col-5">
          <div class="section-1-1">
            <h1>Get Started Now</h1>
            <p>Enter your credentials to access your account</p>
            <hr>
          </div>
          <form method="POST" class="form">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" id="submit" style="background-color: #713cec;">Submit</button>                                               
          </form>
        </div>
        <div class="section-2 col-7">
          <div class="section2-1">
            <h2 style="text-align: left;">The simplest way to manage <br>your workforce</h2>
            <p >Enter your credentials to access your account</p>
          </div>
          <img src="ss1.png" alt="" class="mainImg">
        </div>
      </div>
    </div>

    <div class="toast position-fixed bottom-0 end-0 p-3" id="errorToast" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 9999;">
      <div class="toast-header">
        <strong class="me-auto">Login Error</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Invalid email or password. Please try again.
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        if (typeof showToast !== 'undefined' && showToast) {
          var toastEl = document.getElementById('errorToast');
          var toast = new bootstrap.Toast(toastEl);
          toast.show();
        }
      });
    </script>
  </body>
</html>