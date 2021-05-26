<?php // Logout Script
session_start();
session_destroy(); 
header('Location: ../index.php');
?>