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

if (isset($_GET["loginFailed"]))
{
    $errMessage = "<p class='text-danger font-weight-bold'>".$_GET["loginFailed"]."</p>";
}

if (isset($_POST["login"]))
{
    $loggin = new Login();
    $loggin->setUsername($_POST["username"]);
    $loggin->setPassword($_POST["password"]);

    $e = $loggin->doLogin($conn);
    if ($e)
    {
        if ($loggin->getRole() == "customer")
        {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["role"] = "customer";
            header("Location: menuutama.php");
            exit;
        }
        elseif ($loggin->getRole() == "admin")
        {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["role"] = "admin";
            header("Location: lihatdatarental.php");
            exit;
        }
    }else{
        header("Location: login.php?loginFailed=Gagal : Salah username/password silahkan coba lagi.");
        exit;
    }
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

        <div class="bgdiv-truck" style="height:100vh;">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
            <form method="post">
                <div class="container p-3 w-50">
                    <?php echo $errMessage; ?>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-25 bg-lightblue" id="inputGroup-sizing-default">
                                <img src="img/profile.png" width="37px" height="auto">
                            </span>
                        </div>
                        <input required name="username" style="height:50px;border:none;" placeholder="Username" type="text" class="form-control rounded-25">
                    </div>
                    <div class="input-group mb-3 bg-white rounded-25 shadow">
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-25 bg-lightblue" id="inputGroup-sizing-default">
                                <img src="img/password.jpg" width="auto" height="37px">
                            </span>
                        </div>
                        <input required name="password" style="height:50px;border:none;" placeholder="Password" type="password" class="form-control rounded-25">
                    </div>
                    <button type="submit" name="login" class="btnn bg-redp w-100">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>