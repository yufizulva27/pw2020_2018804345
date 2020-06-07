<?php 
require 'functions.php';

if(isset($_POST['register'])) {
  if(register($_POST) > 0 ) {
    echo "<script>
            alert('User baru berhasil ditambahkan! Silahkan login');
            document.location.href = 'login.php';
          </script>";
  } else {
    echo "User gagal ditambahkan!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Admin</title>
</head>
<body>
  <h3>Registration Admin</h3>
  <form action="" method="post">
  <ul>
    <li>
      <label>
        Username :
        <input type="text" name="username" autofocus autocomplete="off" required>
      </label>
    </li>
    <label>
        Password :
        <input type="password" name="password" required>
      </label>
    </li>
    <li>
    <label>
        Password confirmation :
        <input type="password" name="password2" required>
      </label>
    </li>
    <button type="submit" name="register">Register</button>
  </ul>
  </form>
</body>
</html>