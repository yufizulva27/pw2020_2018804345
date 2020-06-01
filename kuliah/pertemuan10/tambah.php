<?php 
require 'functions.php';

// cek apakah tombol tambah sudah ditekan
if (isset($_POST['tambah'])) {
  // var_dump($_POST);
  if (tambah($_POST) > 0 ) {
    echo "
      <script>
        alert('Data Berhasil ditambahkan');
        document.location.href = 'latihan3.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data Gagal ditambahkan');
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
  <title>Tambah Data Baru</title>
</head>
<body>
<h3>Tambah Data Baru</h3>
<form action="" method="POST">
  <ul>
    <li>
      <label for="npm">
        NPM :
        <input type="text" name="npm" id="npm" autofocus>
      </label>
    </li>
    <li>
      <label for="nama">
        Nama :
        <input type="text" name="nama" id="nama" required>
      </label>
    </li>
    <li>
      <label for="email">
        Email :
        <input type="text" name="email" id="email" required>
      </label>
    </li>
    <li>
      <label for="jurusan">
        Jurusan :
        <input type="text" name="jurusan" id="jurusan" required>
      </label>
    </li>
    <li>
      <label for="gambar">
        Image :
        <input type="text" name="gambar" id="gambar" required>
      </label>
        <li>
          <button type="submit" name="tambah">Tambahkan</button>
        </li>
    </li>
  </ul>

</form>

<a href="latihan3.php">kembali</a>
  
</body>
</html>