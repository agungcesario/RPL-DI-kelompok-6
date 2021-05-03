<?php
require "auth.php";

session_start();

//cek jika session sudah login 
if (isset($_SESSION["username"]))
{
    header("Location: menuutama.php");
    exit;
}

$errMessage = "";
if (isset($_GET["registerFailed"]))
{
    $errMessage = "<p class='text-danger font-weight-bold'>".$_GET["registerFailed"]."</p>";
}

if (isset($_POST["register"]))
{

    // Cek kalau username sudah dipakai
    $stmt = $conn->prepare("SELECT * FROM accounts WHERE username=?");
    $stmt->bind_param("s",$username);
    $username = $_POST["username"];
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0){
        // username sudah dipakai
        header("Location: register.php?registerFailed=Gagal : username sudah dipakai, silahkan pakai yang lain");
        exit;
    }

    // Jika semua kondisi sukses, buat akunnya
    $reg = new Register();
    $reg->setConn($conn);
    $reg->setUsername($_POST["username"]);
    $reg->setPassword($_POST["password"]);
    $reg->setNama($_POST["nama_lengkap"]);
    $reg->setNoTelp(intval($_POST["no_telp"]));
    $reg->setAlamat($_POST["alamat"]);
    $reg->setFotoKTP($_FILES["fotoktp"]);
    $reg->setRole("customer");
    $reg->doRegister();

    $_SESSION["username"] = $reg->getUsername();
    $_SESSION["role"] = "customer";

    header("Location: menuutama.php");
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

        <div class="bgdiv-truck">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:150px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:50px;">CaRent</h2>
            <form class="formRegister" method="post" enctype="multipart/form-data">
                <input type="hidden" name="base64_foto_ktp" value="hehe">
                <div class="container p-3 w-50">
                    <?php echo $errMessage;?>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <input name="nama_lengkap" style="height:50px;border:none;" placeholder="Nama Lengkap" type="text" class="form-control rounded-25" required>
                    </div>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <input required name="alamat" style="height:50px;border:none;" placeholder="Alamat" type="text" class="form-control rounded-25">
                    </div>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <input required name="username" style="height:50px;border:none;" placeholder="Username" type="text" class="form-control rounded-25">
                    </div>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <input required name="password" style="height:50px;border:none;" placeholder="Password" type="password" class="form-control rounded-25">
                    </div>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <input required name="no_telp" style="height:50px;border:none;" placeholder="No Telp" type="number" class="form-control rounded-25">
                    </div>
                    <p class="font-weight-bold">Upload Foto KTP</p>
                    <input required name="fotoktp" id="myfotoktp" type="file"><br>
                    <button type="submit" name="register" class="btnn bg-redp w-100 mt-3">Sign Up</button>
                </div>
            </form>
        </div>
    </body>
</html>