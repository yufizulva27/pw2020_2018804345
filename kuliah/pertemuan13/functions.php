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

function upload() {
  // var_dump($_FILES); die;
  // ambil dari tiap tiap data yg ada di arraynya, supaya mudah dalam penanganan kesalahan
  $name_file = $_FILES['gambar']['name'];
  $type_file = $_FILES['gambar']['type'];
  $tmp_file = $_FILES['gambar']['tmp_name'];
  $error = $_FILES['gambar']['error'];
  $size_file = $_FILES['gambar']['size'];

  // cek ketika tidak ada gambar yg dipilih
  if($error == 4) {
    // echo "
    //   <script>
    //     alert('Pilih gambar terlebih dahulu!');
    //   </script>
    // ";

    return 'nophoto.png';
  }

  // cek eksstensi file
  $daftarFileGambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $name_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  // var_dump($ekstensi_file); die;
  //  if(in_array()) apakah sebuah nilai itu ada didalam array atay tidak. buat kebalikannya yaitu negasi '!'
  if(!in_array($ekstensi_file, $daftarFileGambar)) {
    echo "
      <script>
        alert('File yang anda pilih bukan gambar!');
      </script>
    ";

    return false;
  }

  // cek type file
  if ($type_file != 'image/jpg' && $type_file != 'image/jpeg' && $type_file != 'image/png') {
    echo "
      <script>
        alert('File yang anda pilih bukan gambar!');
      </script>
    ";

    return false;
  }

  // cek ukuran file
  // max size 3Mb = 3000000
  if ($size_file > 3000000) {
    echo "
      <script>
        alert('Ukuran file terlalu besar!');
      </script>
    ";

    return false;
  }

  // genarate nama file atau rubah nama file lama jadi nama file baru
  $nameFileBaru = uniqid();
  $nameFileBaru .= '.';
  $nameFileBaru .= $ekstensi_file;
  // var_dump($nameFileBaru); die;

  // lolos pengecekan, upload file
  move_uploaded_file($tmp_file, 'img/' . $nameFileBaru);

  return $nameFileBaru;
}

function tambah($data) {
  // var_dump($data)
  $conn = koneksi();

  // query insert data
  $npm = htmlspecialchars($data['npm']);
  $nama = htmlspecialchars($data['nama']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  // $img = htmlspecialchars($data['gambar']);

// upload gambar
  $img = upload();
  // berikan nilai false jika tidak ada gambar yg di upload
  if(!$img) {
    return false;
  }

  $query = ("INSERT INTO mahasiswa VALUES('', '$nama', '$npm', '$email', '$jurusan', '$img')");

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);

}

function hapus($id) {
  $conn = koneksi();

  $mhs = query("SELECT * FROM mahasiswa WHERE id = $id");
  if($mhs['gambar'] != 'nophoti.png') {
    unlink('img/' . $mhs['gambar']);
  }

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
  $img_lama = htmlspecialchars($data['gambar_lama']);

  $img = upload();
  if(!$img){
    return false;
  }

  if($img == 'nophoto.png') {
    $img = $img_lama;
  }

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