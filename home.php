<?php

require "auth.php";

session_start();

//cek jika session sudah login 
if (isset($_SESSION["username"]))
{
    header("Location: menuutama.php");
    exit;
}
//tampilan
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CaRent</title>
        <link rel="stylesheet" href="css/main.css">
        <script src="jquery/jquery.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php require 'navbar.php'; ?>

        <div class="bgdiv-truck" style="height:62vh;">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
            <h3 class="text-center pt-2" style="font-style:italic;">Mau cari rental mobil yang berkualitas?, Disini tempatnya, kualitas limosin harga cimin!</h3>
        </div>

        <div class="gradient-light-blue p-3">
        </div>

        <div class="pt-3">
            <h3 class="text-center font-weight-bold">Berbagai Jenis Mobil</h3>
            <div class="container">
                <div class="row">
                    <div class="col"><img src="img/pajero 1.png" style="width:300px;height:auto;"></div>
                    <div class="col"><img src="img/datsun 1.png" style="width:300px;height:auto;"/></div>
                    <div class="col"><img src="img/Unit_Honda-009 1.png" style="width:250px;height:auto;"/></div>
                </div>
            </div>
        </div>

        <div class="bg-grey mt-3" style="height:50vh;">
            <div class="row">
                <div class="col"><img src="img/wallpapap 1.png" style="height:50vh;width:auto" ></div>
                <div class="col">
                    <h3 class="mt-5 mb-3">Untuk dapat menggunakan layanan kami, silahkan registrasi atau login terlebih dahulu.</h3>
                    <button class="btn bg-redp text-white rounded-25 pl-5 pr-5"><h3>Register</h3></button>
                    <button class="btn bg-redp text-white rounded-25 pl-5 pr-5"><h3>Login</h3></button>
                </div>
            </div>
        </div>

        <div class="m-5">
            <div class="row">
                <div class="col">
                    <p class="fsizee">
                        CaRent merupakan penyedia jasa transportasi yang memberikan layanan rental mobil di Bandung tepatnya di wilayah TelkomUniversity dengan berbagai tipe mobil yang dapat disesuaikan dengan kebutuhan mahasiswa
                    </p>
                    <p class="fsizee">
                        CaRent merupakan penyedia jasa transportasi yang memberikan layanan rental mobil di Bandung tepatnya di wilayah TelkomUniversity dengan berbagai tipe mobil yang dapat disesuaikan dengan kebutuhan mahasiswa
                    </p>
                    <p class="fsizee">
                        CaRent merupakan penyedia jasa transportasi yang memberikan layanan rental mobil di Bandung tepatnya di wilayah TelkomUniversity dengan berbagai tipe mobil yang dapat disesuaikan dengan kebutuhan mahasiswa
                    </p>
                </div>
                <div class="col"><img src="img/Ellipse 4.png" class="mx-auto d-block" style="height:100%;width:auto;"/></div>
            </div>
        </div>
        
        <div class="gradient-light-blue p-3">
        </div>

        <div class="bgdiv-truck" style="height:23vh;">
            <h1 class="text-center pt-5" style="font-style:italic;">Harga Cimin, Kualitas Limosin, Nyaman</h1>
        </div>

        <div class="w-100 bg-primary">
            <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
        </div>
    </body>
</html>