<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['user'] = null;
header('Location:index.php');  
?>