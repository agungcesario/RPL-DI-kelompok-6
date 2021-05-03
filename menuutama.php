<?php

require "auth.php";

session_start();

require "loggedin.php";

require "notadminplace.php";

//tampilan halaman
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
        <?php require 'navbar-loggedin.php'; ?>

        <div class="bgdiv-truck" style="height:62vh;">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
            <h3 class="text-center pt-2" style="font-style:italic;">Pilih mobilmu nikmati perjalanannya!</h3>
        </div>

        <div class="gradient-light-blue p-3">
        </div>

        <div class="mt-3 mb-3">
            <div class="container">
                <h3>Tersedia</h3>
                <div class="row">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM data_mobil");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    while ($d = $res->fetch_assoc())
                    {
                        $mobil = new Mobil($conn,$d["id"]);
                        echo '<div class="col m-3">
                        <div class="card shadow" style="width: 18rem; height:25rem;">
                            <img class="card-img-top p-3" src="foto_mobil/'.$mobil->getFoto().'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'.$mobil->getNama().'</h5>
                            </div>
                            <div class="card-footer bg-transparent pb-3 pt-3">
                                <a href="rental.php?id='.$mobil->getId().'" class="btnn bg-redp text-white">Rent Now</a>
                                <button type="button" class="btnn bg-blacknot text-white" data-toggle="modal" data-target="#datamobil_'.$mobil->getId().'">Detail</button>
                            </div>
                        </div>
                    </div>';
                    }
                ?>
                    
                </div>
            </div>
        </div>

        <?php
            $stmt = $conn->prepare("SELECT * FROM data_mobil");
            $stmt->execute();
            $res = $stmt->get_result();
            while ($d = $res->fetch_assoc())
            {
                $mobil = new Mobil($conn,$d["id"]);
                echo '<div class="modal fade" id="datamobil_'.$mobil->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>'.$mobil->getNama().'</td>
                                </tr>
                                <tr>
                                    <td>No Polisi</td>
                                    <td>'.$mobil->getNoPolisi().'</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>'.$mobil->getMerk().'</td>
                                </tr>
                                <tr>
                                    <td>Jenis Mobil</td>
                                    <td>'.$mobil->getJenisMobil().'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>';
            }
                ?>
        <!-- Modal -->
        

        <div class="w-100 bg-primary">
            <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
        </div>
    </body>
</html>