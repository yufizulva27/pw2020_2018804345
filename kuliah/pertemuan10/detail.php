<?php 
require 'functions.php';

// ambil id di URL
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id=$id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>
<body>
<h2>Detail Mahasiswa</h2>
  <form action="" method="post">
    <ul>
      <li><img src="img/<?= $m['gambar']; ?>" width="100"></li>
      <li><b>NPM</b> :<?= $m['npm']; ?></li>
      <li><b>Nama</b> : <?= $m['nama']; ?></li>
      <li><b>Email</b> : <?= $m['email']; ?></li>
      <li><b>Jurusan</b> : <?= $m['jurusan']; ?></li>
      <li>
        <a href="">Edit</a> | <a href="">Delete</a>
      </li>
      <li>
        <a href="latihan3.php">Kembali</a>
      </li>
    </ul>
  </form>
  
</body>
</html>