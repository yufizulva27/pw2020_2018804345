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

$id = $_GET['id'];

if (hapus($id) > 0) {
  echo"
    <script>
      alert('Data berhasil dihapus');
      document.location.href = 'index.php';
    </script>
  ";
} else {
  echo"
    <script>
      alert('Data gagal dihapus');
      document.location.href = 'index.php';
    </script>
  ";
}
?>