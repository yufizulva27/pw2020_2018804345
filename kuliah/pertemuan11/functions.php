<?php 
function koneksi() {
  return mysqli_connect('localhost', 'root', '', 'pw2020_2018804345');
}

function query($query) {
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  // jika hasilnya cuma 1
  if(mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

  return $rows;
}

function tambah($data) {
  // var_dump($data)
  $conn = koneksi();

  // query insert data
  $npm = htmlspecialchars($data['npm']);
  $nama = htmlspecialchars($data['nama']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $img = htmlspecialchars($data['gambar']);

  $query = ("INSERT INTO mahasiswa VALUES('', '$nama', '$npm', '$email', '$jurusan', '$img')");

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);

}

function hapus($id) {
  $conn = koneksi();

  // query delete data
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function update($data) {
  // var_dump($data)
  $conn = koneksi();

  // query insert data
  $id = $data['id'];
  $npm = htmlspecialchars($data['npm']);
  $nama = htmlspecialchars($data['nama']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $img = htmlspecialchars($data['gambar']);

  $query = "UPDATE mahasiswa SET
              nama = '$nama',
              npm = '$npm',
              email = '$email',
              jurusan = '$jurusan',
              gambar = '$img'
              WHERE id = '$id' ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);

}

function search($keyword) {
  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa WHERE 
  nama LIKE '%$keyword%' OR
  npm LIKE '%$keyword%' OR
  email LIKE '%$keyword%' OR
  jurusan LIKE '%$keyword%' ";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

  return $rows;
}



?>