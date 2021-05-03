<?php

//cek jika session belum login 
if (!isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}

$customer = new Customer($conn, $_SESSION["username"]);

?>