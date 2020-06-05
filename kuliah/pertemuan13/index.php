<?php
session_start();
// jika !isset login atau belm login maka paksa user untuk login terlebih dahulu
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

if(isset($_POST['search'])) {
  $mahasiswa = search($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Daftar Mahasiswa</title>
</head>
<body>

  <div class="container alert alert-primary" role="alert">
    <h1 align="center">Daftar Mahasiswa</h1>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
  <div class="container">
    <nav class="navbar navbar-light bg-light">
      <a href="tambah.php" class="btn btn-primary">Tamba Data Baru</a>
      <form class="form-inline" action="" method="post">
        <input class="keyword form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search" autocomplete="off" autofocus>
        <button class="tombol-cari btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
      </form>
    </nav>
  </div>

<div class="table-ajax container">
    <table class="table table-striped">
      <form action="" method="post">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Nama</th>
          <th scope="col">Opsi</th>
        </tr>
      </thead>

        <?php if(empty($mahasiswa)) : ?>
          <tr>
            <td colspan="4">
              <p style="color: red; font-style: italic; font-size: 30px;" align="center" >Data tidak ditemukan!</p>
            </td>
          </tr>
        <?php endif; ?>

        <?php $i=1;
        foreach($mahasiswa as $mhs) : ?>
          <tbody>
          <tr>
            <th scope="row"><?= $i++; ?></th>
            <td><img src="img/<?= $mhs['gambar']; ?>" width="70"></td>
            <td><?= $mhs['nama']; ?></td>
            <td>
              <a href="detail.php?id=<?= $mhs['id']; ?>" class="btn btn-info">Lihat Detail</a>
              <a href="hapus.php?id=<?= $mhs['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin')">Delete</a>
            </td>
          </tr>
        </tbody>
        <?php endforeach; ?>
      </form>
    </table>
</div>

<!-- ajax live search javascript -->
<script src="js/script.js"></script>

<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>