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

function register($data) {
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password = mysqli_real_escape_string($conn, $data['password']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // cek jika username / password kosong
  if(empty($username) || empty($password) || empty($password2)) {
    echo "
      <script>
        alert('username / password tidak boleh kosong!');
        document.location.href = 'registrasi.php';
      </script>
    ";

    return false;
  }

  // jika username sudah terdaftar
  if(query("SELECT * FROM tb_admin WHERE username = '$username'")) {
    echo "
      <script>
        alert('username sudah terdaftar!');
        document.loctaion.href = 'registrasi.php';
      </script>
    ";

    return false;
  }

  // jika konfirmasi password tidak sesuai
  if($password !== $password2) {
    echo "
      <script>
        alert('konfirmasi password tidak sesuai!');
        document.location.href = 'registrasi.php';
      </script>
    ";
    return false;
  }

  // jika lenght password < 5 digit maka gagal register
  if(strlen($password) < 5 ){
    echo "
      <script>
        alert('password terlalu pendek!');
        document.location.href = 'registrasi.php';
      </script>
    ";

    return false;
  }

  // jika username / passowrd sesuai maka enkripsi password
  $password_baru = password_hash($password, PASSWORD_DEFAULT);

  // insert usernam dan password ke database
  $query = "INSERT INTO tb_admin VALUES ('', '$username', '$password_baru')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function login($data) {
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

    // cek dulu username
  if($user = query("SELECT * FROM tb_admin WHERE username = '$username' ")) {
    // cek password
    if(password_verify($password, $user['password'])) {
      // set session
      $_SESSION['login'] = true;
      header("Location: index.php ");
      exit;
    }
  }
    return [
      'error' => true,
      'pesan' => 'Username / Password Salah!'
    ];
}
?>