<?php
session_start();
// jika isset login atau sudah login maka jangan tampilkan halaman login lagi kecuali logout
if(isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';


// ketika tombol login di tekan
if(isset($_POST['login'])) {
  // maka panggil fungsi login yg mengirimkan data POST
  $login = login($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h3>Login Admin</h3>
<form action="" method="post">
  <?php if(isset($login['error'])) : ?>
    <p style="color: red; font-style: italic;"><?= $login['pesan']; ?></p>
  <?php endif; ?>
  <ul>
    <li>
      <label>
        Username :
        <input type="text" name="username" autofocus autocomplet="off" required>
      </label>
    </li>
    <li>
      <label>
        Password :
        <input type="password" name="password" required>
      </label>
    </li>
    <button type="submit" name="login">Login</button>
    
    <li><a href="registrasi.php">Registration</a></li>
    
  </ul>
</form>
</body>
</html>