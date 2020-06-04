<?php
session_start();
// jika !isset login atau belm login maka paksa user untuk login terlebih dahulu
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Detail Mahasiswa</title>
</head>
<body>
<div class="container">
  <h2>Detail Mahasiswa</h2>
    
        <!-- <div class="card" style="width: 18rem;">
            <img src="img/<?= $m['gambar']; ?>" class="card-img-top">
            <div class="card-body">
              <li><b>NPM</b> :<?= $m['npm']; ?></li>
                <li><b>Nama</b> : <?= $m['nama']; ?></li>
                <li><b>Email</b> : <?= $m['email']; ?></li>
                <li><b>Jurusan</b> : <?= $m['jurusan']; ?></li>
                <a href="edit.php" class="btn btn-info">Edit</a>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div> -->
    
    <form action="" method="post">
    <div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="img/<?= $m['gambar']; ?>" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <li><b>NPM</b> :<?= $m['npm']; ?></li>
                <li><b>Nama</b> : <?= $m['nama']; ?></li>
                <li><b>Email</b> : <?= $m['email']; ?></li>
                <li><b>Jurusan</b> : <?= $m['jurusan']; ?></li>
                <a href="edit.php?id=<?= $m['id']; ?>" class="btn btn-info">Edit</a>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>
</div>
</div>
</form>

  <!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>