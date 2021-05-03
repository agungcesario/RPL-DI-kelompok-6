<?php

require "auth.php";

session_start();

$mobilid = $_GET["id"];

$mobil = new Mobil($conn,$mobilid);

require "loggedin.php";

if (isset($_POST["rent"]))
{

    $rental = new Rental($conn);
    $rental->setUsername($customer->getUsername());
    $rental->setIdAcc($customer->getId());
    $rental->setWaktuRental($_POST["durasi"]);
    $rental->setTanggalRental($_POST["tanggalrental"]);
    $rental->setTotalHarga(intval($_POST["totalharga"]));
    $rental->setKeterangan("Tanggal Rental : ".$_POST["tanggalrental"]);
    $rental->tambahKeDB();

    echo "<script>alert('Rental Berhasil');window.location.href='menuutama.php'</script>";
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
        <?php require 'navbar-loggedin.php'; ?>

        <div class="bgdiv-truck pb-3">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
        </div>

        <div class="gradient-light-blue p-3">
        </div>

        <div class="container mb-3">
            <h3><?php echo $mobil->getNama(); ?></h3>
            <div class="row">
                <div class="col">
                    <img src="foto_mobil/<?php echo $mobil->getFoto(); ?>" class="pt-5 mx-auto d-block" style="width:auto; height:100%;">
                </div>
                <div class="col">
                    <p>Merk : <?php echo $mobil->getMerk(); ?></p>
                    <p>Jenis : <?php echo $mobil->getJenisMobil(); ?></p>
                    <p>No.Polisi : <?php echo $mobil->getNoPolisi(); ?></p>
                    <p>Pricelist :</p>
                    <p>Rp <?php echo $mobil->getHarga12Jam(); ?>/12 jam</p>
                    <p>Rp <?php echo $mobil->getHarga24Jam(); ?>/24 jam</p>
                </div>
                <div class="col">
                    <label for="tglrental">Tanggal Rental :</label>
                    <input type="date" id="tglrental" name="tglrental">
                    <div class="form-check">
                        <input checked class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="rb12jam form-check-label" for="flexRadioDefault1">
                            12 Jam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="rb24jam form-check-label" for="flexRadioDefault2">
                            24 Jam
                        </label>
                    </div>
                    <form method="post">
                        <input id="f_idacc" type="hidden" name="idacc" value="<?php echo $customer->getId(); ?>">
                        <input id="f_tanggalrental" type="hidden" name="tanggalrental" value="">
                        <input id="f_durasi" type="hidden" name="durasi" value="12">
                        <input id="f_totalharga" type="hidden" name="totalharga" value="<?php echo $mobil->getHarga12Jam(); ?>">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Tanggal Rental</td>
                                    <td id="tanggaltd">11 Maret 2020</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td id="durasi">12 Jam</td>
                                </tr>
                                <tr>
                                    <td>Total Harga Rental</td>
                                    <td id="totalharga">Rp.<?php echo $mobil->getHarga12Jam(); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" name="rent" class="btnn bg-redp">Rent Now</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-100 bg-primary">
            <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
        </div>
        <script>
        function padLeadingZeros(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }

        function inputDateToStringDate(val)
        {
            let year = val.substr(0,4);
            let month = parseInt(val.substr(5,2))-1;
            let date = val.substr(8,2);

            return date + " " + namaBulan[month] + " " + year
        }
        let namaBulan = [
            "Januari","Februari","Maret","April","May","Juni","Juli","Agustus","September","October","November","Desember"
        ]
        let nowDate = new Date();
        $('#tglrental').val(
            nowDate.getFullYear()+"-"+padLeadingZeros(nowDate.getMonth()+1,2)+"-"+padLeadingZeros(nowDate.getDate(),2)
            );
        
        $("#f_tanggalrental").val(nowDate.getFullYear()+"-"+padLeadingZeros(nowDate.getMonth()+1,2)+"-"+padLeadingZeros(nowDate.getDate(),2))
        $("#tanggaltd").html(inputDateToStringDate($('#tglrental').val()))
        $("#tglrental").change(function()
        {
            $("#f_tanggalrental").val(nowDate.getFullYear()+"-"+padLeadingZeros(nowDate.getMonth()+1,2)+"-"+padLeadingZeros(nowDate.getDate(),2))
            $("#tanggaltd").html(inputDateToStringDate($('#tglrental').val()))
        })

        $(".rb12jam").click(function()
        {
            $("#f_durasi").val(12)
            $("#durasi").html("12 Jam");
            $("#totalharga").html("Rp.<?php echo $mobil->getHarga12Jam(); ?>")
            $("#f_totalharga").val(<?php echo $mobil->getHarga12Jam(); ?>)
        })

        $(".rb24jam").click(function()
        {
            $("#f_durasi").val(24)
            $("#durasi").html("24 Jam");
            $("#totalharga").html("Rp.<?php echo $mobil->getHarga24Jam(); ?>")
            $("#f_totalharga").val(<?php echo $mobil->getHarga24Jam(); ?>)
        })
        </script>
    </body>
</html>