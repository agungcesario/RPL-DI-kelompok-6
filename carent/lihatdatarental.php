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
                            <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>