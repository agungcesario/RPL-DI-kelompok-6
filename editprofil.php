<?php

require "auth.php";

session_start();

require "loggedin.php";

if (isset($_POST["editprofil"]))
{
    $customer->setUsername($_POST["username"]);
    $_SESSION["username"] = $customer->getUsername();

    $customer->setAlamat($_POST["alamat"]);
    $customer->setNama($_POST["nama"]);
    $customer->setPassword($_POST["password"]);
    $customer->setNoTelp(intval($_POST["notelp"]));

    if ($_FILES["fotoktp"]["tmp_name"] != null)
    {
        $customer->setFotoKTP($_FILES["fotoktp"]);
    }

    header("Location:editprofil.php");
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

        <div class="bgdiv-truck" style="height:123vh;">
            
            <div class="row" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0" style="height:123vh;">
                    <a href="editprofil.php" class="btn bg-lightblue text-dark w-100 m-0 font-weight-bold">Edit Profil</a>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Edit Profil</h3>
                    <form method="post" enctype="multipart/form-data">
                        <div class="container p-3 w-50">
                            <div class="input-group mb-3 bg-white rounded-25 shadow">
                                <input name="nama" style="height:50px;border:none;" value="<?php echo $customer->getNama(); ?>" placeholder="Nama Lengkap" type="text" class="form-control rounded-25">
                            </div>
                            <div class="input-group mb-3 bg-white rounded-25 shadow">
                                <input name="alamat" style="height:50px;border:none;" value="<?php echo $customer->getAlamat(); ?>" placeholder="Alamat" type="text" class="form-control rounded-25">
                            </div>
                            <div class="input-group mb-3 bg-white rounded-25 shadow">
                                <input name="username" style="height:50px;border:none;" value="<?php echo $customer->getUsername(); ?>" placeholder="Username" type="text" class="form-control rounded-25">
                            </div>
                            <div class="input-group mb-3 bg-white rounded-25 shadow">
                                <input name="password" style="height:50px;border:none;" value="<?php echo $customer->getPassword(); ?>" placeholder="Password" type="password" class="form-control rounded-25">
                            </div>
                            <div class="input-group mb-3 bg-white rounded-25 shadow">
                                <input name="notelp" style="height:50px;border:none;" value="<?php echo $customer->getNoTelp(); ?>" placeholder="No Telp" type="text" class="form-control rounded-25">
                            </div>
                            <p class="font-weight-bold">Upload Foto KTP</p>
                            <input name="fotoktp" type="file"><br><br>
                            <img src="foto_ktp/<?php echo $customer->getFotoKTP(); ?>" height="100" width="auto">
                            <button type="submit" name="editprofil" class="btnn bg-redp w-100 mt-3">Simpan</button>
                            <button type="button" onclick="window.location.href='home.php'" class="btnn bg-redp w-100 mt-3">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>