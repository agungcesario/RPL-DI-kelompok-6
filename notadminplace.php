<?php
// cek kalo yg akses admin maka redirect ke lihatdatarental.php
if ($_SESSION["role"] == "admin")
{
    header("Location: lihatdatarental.php");
    exit;
}
?>