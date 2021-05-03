<?php

//cek jika session belum login 
if (!isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}

$admin = new Admin($conn, $_SESSION["username"]);

?>