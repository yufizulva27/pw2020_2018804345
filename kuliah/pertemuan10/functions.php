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
?>