<?php
require "auth.php";

session_start();

require "loggedin-admin.php";
//cek jika menambah
if (isset($_POST["tambah"]))
{
    $admin->inputMobil(
        $_POST["nama"],
        $_POST["nopolisi"],
        $_POST["merk"],
        $_POST["jenismobil"],
        $_FILES["foto"],
        intval($_POST["hargarental12jam"]),
        intval($_POST["hargarental24jam"])
    );

    header("Location: editdatamobil.php");
    exit;
}
//cek jika menghapus
if (isset($_POST["hapus"]))
{
    $admin->deleteMobil($_POST["hapus"]);
    header("Location: editdatamobil.php");
    exit;
}
//cek jika mengedit
if (isset($_POST["edit"]))
{
    $admin->editMobil(
        $_POST["edit"],
        $_POST["nama"],
        $_POST["nopolisi"],
        $_POST["merk"],
        $_POST["jenismobil"],
        $_FILES["foto"],
        intval($_POST["hargarental12jam"]),
        intval($_POST["hargarental24jam"])
    );

    header("Location: editdatamobil.php");
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
        <?php require 'navbar-admin-loggedin.php'; ?>
        <div class="bgdiv-truck" style="height:100vh;">
            
            <div class="row" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0" style="height:100vh;">
                    <a href="lihatdatarental.php" class="btn bg-lightblue text-dark w-100 m-0">Lihat Data Rental</a>
                    <a href="editdatamobil.php" class="btn bg-lightblue text-dark w-100 m-0 font-weight-bold">Edit Data Mobil</a>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Edit Data Mobil</h3>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mobil</button>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor Polisi</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Jenis Mobil</th>
                            <th scope="col">Harga Rental 12 Jam</th>
                            <th scope="col">Harga Rental 24 Jam</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM data_mobil");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $i = 0;
                            while ($d = $res->fetch_assoc())
                            {
                                $i++;
                                $mobil = new Mobil($conn,$d["id"]);
                                echo '
                                <input type="hidden" id="nama_'.$mobil->getId().'" value="'.$mobil->getNama().'">
                                <input type="hidden" id="nopolisi_'.$mobil->getId().'" value="'.$mobil->getNoPolisi().'">
                                <input type="hidden" id="merk_'.$mobil->getId().'" value="'.$mobil->getMerk().'">
                                <input type="hidden" id="jenismobil_'.$mobil->getId().'" value="'.$mobil->getJenisMobil().'">
                                <input type="hidden" id="foto_'.$mobil->getId().'" value="'.$mobil->getFoto().'">
                                <input type="hidden" id="hargarental12jam_'.$mobil->getId().'" value="'.$mobil->getHarga12Jam().'">
                                <input type="hidden" id="hargarental24jam_'.$mobil->getId().'" value="'.$mobil->getHarga24Jam().'">
                                <tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$mobil->getNama().'</td>
                                <td>'.$mobil->getNoPolisi().'</td>
                                <td>'.$mobil->getMerk().'</td>
                                <td>'.$mobil->getJenisMobil().'</td>
                                <td>Rp '.$mobil->getHarga12Jam().'</td>
                                <td>Rp '.$mobil->getHarga24Jam().'</td>
                                <td>
                                <form method="post"><button mobilId="'.$mobil->getId().'" type="button" class="editMobilBtn btn btn-warning" data-toggle="modal" data-target=".editMobilModal">Edit</button>
                                    <button type="submit" name="hapus" value="'.$mobil->getId().'" class="btn btn-danger">Delete</button></form>
                                </td>
                            </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Mobil -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Mobil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input name="nama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="nopolisi" style="height:50px;border:none;" placeholder="Nomor polisi" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="merk" style="height:50px;border:none;" placeholder="Merk" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="jenismobil" style="height:50px;border:none;" placeholder="Jenis mobil" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="hargarental12jam" style="height:50px;border:none;" placeholder="Harga Rental / 12 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="hargarental24jam" style="height:50px;border:none;" placeholder="Harga Rental / 24 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Mobil</p>
                        <input required name="foto" id="myfotomobil" type="file"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Mobil -->
        <div class="modal fade editMobilModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Mobil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editnama" name="nama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editnopolisi" required name="nopolisi" style="height:50px;border:none;" placeholder="Nomor polisi" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editmerk" required name="merk" style="height:50px;border:none;" placeholder="Merk" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editjenismobil" required name="jenismobil" style="height:50px;border:none;" placeholder="Jenis mobil" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="edithargarental12jam" required name="hargarental12jam" style="height:50px;border:none;" placeholder="Harga Rental / 12 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="edithargarental24jam" required name="hargarental24jam" style="height:50px;border:none;" placeholder="Harga Rental / 24 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Mobil</p>
                        <input name="foto" id="myfotomobil" type="file"><br><br>
                        <img src="foto_mobil/" id="editfoto" height="100" width="auto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="editbtn" name="edit" value="0" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
        $(".editMobilBtn").click(function(e)
        {
            let mobilid = $(e.currentTarget).attr("mobilId");
            $("#editnama").val($("#nama_"+mobilid).val())
            $("#editnopolisi").val($("#nopolisi_"+mobilid).val())
            $("#editmerk").val($("#merk_"+mobilid).val())
            $("#editjenismobil").val($("#jenismobil_"+mobilid).val())
            $("#edithargarental12jam").val($("#hargarental12jam_"+mobilid).val())
            $("#edithargarental24jam").val($("#hargarental24jam_"+mobilid).val())
            $("#editfoto").attr("src","foto_mobil/"+$("#foto_"+mobilid).val())
            $("#editbtn").val(mobilid);
        })
        </script>
    </body>
</html>