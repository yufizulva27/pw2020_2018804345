<?php
require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

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
<div class="container">
  <div class="alert alert-primary" role="alert">
    <h1 align="center">Daftar Mahasiswa</h1>
  </div>

    <a href="tambah.php" class="btn btn-primary">Tamba Data Baru</a>
</div><br>
<div class="container">
    <table class="table table-striped">
    <form action="" method="post">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Nama</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>

  <?php $i=1;
  foreach($mahasiswa as $mhs) : ?>
    <tbody>
    <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><img src="img/<?= $mhs['gambar']; ?>" width="70"></td>
      <td><?= $mhs['nama']; ?></td>
      <td>
      <a href="detail.php?id=<?= $mhs['id']; ?>" class="btn btn-info">Lihat Detail</a>
      </td>
    </tr>
  </tbody>
  <?php endforeach; ?>
     </form>
    </table>
    </div>

<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>