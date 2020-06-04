<?php
session_start();
// jika !isset login atau belm login maka paksa user untuk login terlebih dahulu
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// jika tidak ada id di url maka paksa ke index
if(!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil data dari url
$id = $_GET['id'];

// query data dari tabel mahasiswa
$m = query("SELECT * FROM mahasiswa WHERE id =$id");
// var_dump($m);

// cek apakah tombol update sudah ditekan
if (isset($_POST["update"])) {
  // var_dump($_POST);
  if (update($_POST) > 0 ) {
    echo "
      <script>
        alert('Data Berhasil diupdate');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data Gagal diupdate');
      </script>
    ";
  }
}

// cek apakah data berhasil di tambah
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Data</title>
</head>
<body>
<h3>Update Data</h3>

<form action="" method="POST">
<input type="hidden" name="id" value="<?= $m['id']; ?>">
  <ul>
    <li>
      <label for="npm">
        NPM :
        <input type="text" name="npm" id="npm" autofocus value="<?= $m['npm']; ?>">
      </label>
    </li>
    <li>
      <label for="nama">
        Nama :
        <input type="text" name="nama" id="nama" required value="<?= $m['nama']; ?>">
      </label>
    </li>
    <li>
      <label for="email">
        Email :
        <input type="text" name="email" id="email" required value="<?= $m['email']; ?>">
      </label>
    </li>
    <li>
      <label for="jurusan">
        Jurusan :
        <input type="text" name="jurusan" id="jurusan" required value="<?= $m['jurusan']; ?>">
      </label>
    </li>
    <li>
      <label for="gambar">
        Image :
        <input type="text" name="gambar" id="gambar" required value="<?= $m['gambar']; ?>">
      </label>
        <li>
          <button type="submit" name="update">Update</button>
        </li>
    </li>
  </ul>

</form>

<a href="index.php">kembali</a>
  
</body>
</html>