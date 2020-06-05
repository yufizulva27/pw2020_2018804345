<?php 
session_start();
// session_destroy(); untuk membersihkan semua session
session_destroy();
header("Location: login.php");
exit;

?>

