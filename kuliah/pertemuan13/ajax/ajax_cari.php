<?php 
require '../functions.php';
 $mahasiswa = search($_GET['keyword']);
?>

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