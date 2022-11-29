<?php
session_start();
unset($_SESSION['username']);
$_SESSION['logged'] = false;

session_destroy();
header("location:login.php");
?>