<?php
require "auth.php";

session_start();

require "loggedin-admin.php";
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
        <?php require 'navbar-admin-loggedin.php'; ?>

        <div class="bgdiv-truck" style="height:100vh;">
            
            <div class="row" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0" style="height:100vh;">
                    <a href="lihatdatarental.php" class="btn bg-lightblue text-dark w-100 m-0 font-weight-bold">Lihat Data Rental</a>
                    <a href="editdatamobil.php" class="btn bg-lightblue w-100 m-0 text-dark">Edit Data Mobil</a>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Lihat Data Rental</h3>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Waktu Rental</th>
                            <th scope="col">Total Harga Rental</th>
                            <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM data_rental;");
                                $stmt->execute();
                                $res = $stmt->get_result();
                                $i = 0;
                                while ($d = $res->fetch_assoc())
                                {
                                    $i++;
                                    $dataRental = new Rental($conn);
                                    $dataRental->getDataFromIdDB($d["id"]);
                                    echo '<tr><th scope="row">'.$i.'</th>
                                    <td>'.$dataRental->getUsername().'</td>
                                    <td>'.$dataRental->getWaktuRental().' Jam</td>
                                    <td>Rp.'.$dataRental->getTotalHarga().'</td>
                                    <td>'.$dataRental->getKeterangan().'</td>
                                    </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>