<?php

session_start();

// menghapus data session
session_destroy();

// redirect ke login
header('location:login.php');

?>