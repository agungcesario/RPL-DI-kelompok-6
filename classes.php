<?php

class MySQLData {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    function setServerName(string $servername)
    {
        $this->servername = $servername;
    }

    function getServerName() : string
    {
        return $this->servername;
    }

    function setUsername(string $username)
    {
        $this->username = $username;
    }

    function getUsername() : string
    {
        return $this->username;
    }

    function setPassword(string $password)
    {
        $this->password = $password;
    }

    function getPassword() : string
    {
        return $this->password;
    }

    function setDBName(string $dbname)
    {
        $this->dbname = $dbname;
    }

    function getDBName() : string
    {
        return $this->dbname;
    }

    function connect() : bool
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if ($this->conn->connect_error) {
            return false;
        }
        return true; 
                   
    }

    function getConn() : mysqli
    {
        return $this->conn;
    }

}

class Login
{
    private $username;
    private $password;
    private $role;

    function setUsername($username)
    {
        $this->username = $username;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setRole($role)
    {
        $this->password = $role;
    }

    function getRole()
    {
        return $this->role;
    }

    function doLogin(mysqli $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE username = ? AND password = ?");
        $stmt->bind_param("ss",$inputUsername,$inputPassword);
        $inputUsername = $this->username;
        $inputPassword = $this->password;
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        
        if ($res->num_rows > 0)
        {
            $this->role = $data["role"];
            return true;
        }
        return false;
    }

}

class Register
{
    private $conn;
    private $username;
    private $password;
    private $nama;
    private $alamat;
    private $no_telp;
    private $foto_ktp;
    private $role;

    function setConn(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function doRegister()
    {
        $stmt = $this->conn->prepare("INSERT INTO accounts (username,password,nama_lengkap,alamat,notelp,ktp,role) values (?,?,?,?,?,?,?)");
        $stmt->bind_param(
            "ssssiss",
            $username,
            $password,
            $nama,
            $alamat,
            $no_telp,
            $foto_ktp,
            $role
        );
        $username = $this->username;
        $password = $this->password;
        $nama = $this->nama;
        $alamat = $this->alamat;
        $no_telp = $this->no_telp;
        $foto_ktp = $this->foto_ktp;
        $role = $this->role;
        echo $stmt->execute();
    }

    function setUsername(string $username)
    {
        $this->username = $username;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setPassword(string $password)
    {
        $this->password = $password;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setNama(string $nama)
    {
        $this->nama = $nama;
    }

    function setAlamat(string $alamat)
    {
        $this->alamat = $alamat;
    }

    function setNoTelp(int $no_telp)
    {
        $this->no_telp = $no_telp;
    }

    function setFotoKTP($foto_ktp)
    {
        $foto_ktp_path = "fotoktp_".strval(rand(0,1000000)).$foto_ktp["name"];
        move_uploaded_file($foto_ktp["tmp_name"],"foto_ktp/$foto_ktp_path");
        $this->foto_ktp = $foto_ktp_path;
    }

    function setRole(string $role)
    {
        $this->role = $role;
    }
}

class Customer
{
    private $id;
    private $username;
    private $password;
    private $nama;
    private $alamat;
    private $no_telp;
    private $fotoktp;
    private $conn;

    function __construct(mysqli $conn,$username)
    {
        $this->conn = $conn;
        $stmt = $this->conn->prepare("SELECT * FROM accounts WHERE username = ?");
        $stmt->bind_param("s",$inputUsername);
        $inputUsername = $username;
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->password = $data["password"];
        $this->nama = $data["nama_lengkap"];
        $this->alamat = $data["alamat"];
        $this->no_telp = $data["notelp"];
        $this->fotoktp = $data["ktp"];
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($username)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET username=? WHERE id=?");
        $stmt->bind_param("si",$inputUsername,$inputId);
        $inputUsername = $username;
        $inputId = $this->id;
        $stmt->execute();
        $this->username = $username;
    }

    function getNama()
    {
        return $this->nama;
    }

    function setNama($nama)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET nama_lengkap=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $nama;
        $inputId = $this->id;
        $stmt->execute();
        $this->nama = $nama;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET password=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $password;
        $inputId = $this->id;
        $stmt->execute();
        $this->password = $password;
    }

    function getAlamat()
    {
        return $this->alamat;
    }

    function setAlamat($alamat)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET alamat=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $alamat;
        $inputId = $this->id;
        $stmt->execute();
        $this->alamat = $alamat;
    }

    function getNoTelp()
    {
        return $this->no_telp;
    }

    function setNoTelp($notelp)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET notelp=? WHERE id=?");
        $stmt->bind_param("ii",$input1,$inputId);
        $input1 = $notelp;
        $inputId = $this->id;
        $stmt->execute();
        $this->no_telp = $notelp;
    }

    function getId()
    {
        return $this->id;
    }

    function getFotoKTP()
    {
        return $this->fotoktp;
    }

    function setFotoKTP($foto_ktp)
    {
        $foto_ktp_path = "fotoktp_".strval(rand(0,1000000)).$foto_ktp["name"];
        move_uploaded_file($foto_ktp["tmp_name"],"foto_ktp/$foto_ktp_path");
        $stmt = $this->conn->prepare("UPDATE accounts SET ktp=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $foto_ktp_path;
        $inputId = $this->id;
        $stmt->execute();
        $this->fotoktp = $foto_ktp_path;
    }
}

class Mobil 
{
    private $id;
    private $nomor_polisi;
    private $nama;
    private $merk;
    private $jenis_mobil;
    private $foto;
    private $harga_rental_12jam;
    private $harga_rental_24jam;
    private $conn;

    function __construct(mysqli $conn,$id)
    {
        $this->conn = $conn;
        $stmt = $this->conn->prepare("SELECT * FROM data_mobil WHERE id = ?");
        $stmt->bind_param("i",$input1);
        $input1 = $id;
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->nomor_polisi = $data["nomor_polisi"];
        $this->merk = $data["merk"];
        $this->nama = $data["nama"];
        $this->jenis_mobil = $data["jenis_mobil"];
        $this->foto = $data["foto"];
        $this->harga_rental_12jam = $data["harga_rental_12jam"];
        $this->harga_rental_24jam = $data["harga_rental_24jam"];
    }

    function getId()
    {
        return $this->id;
    }

    function getNama()
    {
        return $this->nama;
    }

    function setNama($nama)
    {
        $stmt = $this->conn->prepare("UPDATE data_mobil SET nama=? WHERE id = ?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $nama;
        $inputId = $this->getId();
        $stmt->execute();

        $this->nama = $nama;
    }

    function getNoPolisi()
    {
        return $this->nomor_polisi;
    }

    function setNoPolisi($nomor_polisi)
    {
        $stmt = $this->conn->prepare("UPDATE data_mobil SET nomor_polisi=? WHERE id = ?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $nomor_polisi;
        $inputId = $this->getId();
        $stmt->execute();

        $this->nomor_polisi = $nomor_polisi;
    }

    function getMerk()
    {
        return $this->merk;
    }

    function setMerk($merk)
    {
        $stmt = $this->conn->prepare("UPDATE data_mobil SET merk=? WHERE id = ?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $merk;
        $inputId = $this->getId();
        $stmt->execute();

        $this->merk = $merk;
    }


    function getJenisMobil()
    {
        return $this->jenis_mobil;
    }

    function setJenisMobil($jenis_mobil)
    {
        $stmt = $this->conn->prepare("UPDATE data_mobil SET jenis_mobil=? WHERE id = ?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $jenis_mobil;
        $inputId = $this->getId();
        $stmt->execute();

        $this->jenis_mobil = $jenis_mobil;
    }

    function getHarga12Jam()
    {
        return $this->harga_rental_12jam;
    }

    function setHarga12Jam($harga_rental_12jam)
    {
        $stmt = $this->conn->prepare("UPDATE data_mobil SET harga_rental_12jam=? WHERE id = ?");
        $stmt->bind_param("ii",$input1,$inputId);
        $input1 = $harga_rental_12jam;
        $inputId = $this->getId();
        $stmt->execute();

        $this->harga_rental_12jam = $harga_rental_12jam;
    }

    function getHarga24Jam()
    {
        return $this->harga_rental_24jam;
    }

    function setHarga24Jam($harga_rental_24jam)
    {
        $stmt = $this->conn->prepare("UPDATE data_mobil SET harga_rental_24jam=? WHERE id = ?");
        $stmt->bind_param("ii",$input1,$inputId);
        $input1 = $harga_rental_24jam;
        $inputId = $this->getId();
        $stmt->execute();

        $this->harga_rental_24jam = $harga_rental_24jam;
    }

    function getFoto()
    {
        return $this->foto;
    }

    function setFoto($foto)
    {
        $fotoPath = "fotoktp_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_mobil/$fotoPath");
        $stmt = $this->conn->prepare("UPDATE accounts SET ktp=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $fotoPath;
        $inputId = $this->id;
        $stmt->execute();
        $this->foto = $fotoPath;
    }
}

class Admin
{
    private $id;
    private $username;
    private $password;
    private $nama;
    private $alamat;
    private $no_telp;
    private $fotoktp;
    private $conn;

    function __construct(mysqli $conn,$username)
    {
        $this->conn = $conn;
        $stmt = $this->conn->prepare("SELECT * FROM accounts WHERE username = ?");
        $stmt->bind_param("s",$inputUsername);
        $inputUsername = $username;
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->password = $data["password"];
        $this->nama = $data["nama_lengkap"];
        $this->alamat = $data["alamat"];
        $this->no_telp = $data["notelp"];
        $this->fotoktp = $data["ktp"];
    }

    function syncWithDB()
    {
        $stmt = $this->conn->prepare("SELECT * FROM accounts WHERE id = ?");
        $stmt->bind_param("s",$this->id);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->password = $data["password"];
        $this->nama = $data["nama_lengkap"];
        $this->alamat = $data["alamat"];
        $this->no_telp = $data["notelp"];
        $this->fotoktp = $data["ktp"];
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($username)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET username=? WHERE id=?");
        $stmt->bind_param("si",$inputUsername,$inputId);
        $inputUsername = $username;
        $inputId = $this->id;
        $stmt->execute();
        $this->username = $username;
    }

    function getNama()
    {
        return $this->nama;
    }

    function setNama($nama)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET nama_lengkap=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $nama;
        $inputId = $this->id;
        $stmt->execute();
        $this->nama = $nama;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET password=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $password;
        $inputId = $this->id;
        $stmt->execute();
        $this->password = $password;
    }

    function getAlamat()
    {
        return $this->alamat;
    }

    function setAlamat($alamat)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET alamat=? WHERE id=?");
        $stmt->bind_param("si",$input1,$inputId);
        $input1 = $alamat;
        $inputId = $this->id;
        $stmt->execute();
        $this->alamat = $alamat;
    }

    function getNoTelp()
    {
        return $this->no_telp;
    }

    function setNoTelp($notelp)
    {
        $stmt = $this->conn->prepare("UPDATE accounts SET notelp=? WHERE id=?");
        $stmt->bind_param("ii",$input1,$inputId);
        $input1 = $notelp;
        $inputId = $this->id;
        $stmt->execute();
        $this->no_telp = $notelp;
    }

    function getId()
    {
        return $this->id;
    }

    function getFotoKTP()
    {
        return $this->fotoktp;
    }

    function setFotoKTP($foto_ktp)
    {
        $foto_ktp_path = "fotoktp_".strval(rand(0,1000000)).$foto_ktp["name"];
        move_uploaded_file($foto_ktp["tmp_name"],"foto_ktp/$foto_ktp_path");
        $stmt = $this->conn->prepare("UPDATE accounts SET ktp=? WHERE id=?");
        $stmt->bind_param("si",$foto_ktp_path,$this->id);
        $stmt->execute();
        $this->fotoktp = $foto_ktp_path;
    }

    function inputMobil($nama, $nomor_polisi, $merk, $jenis_mobil, $foto, $harga_rental_12jam, $harga_rental_24jam)
    {
        $foto_mobil_path = "fotomobil_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_mobil/$foto_mobil_path");
        $stmt = $this->conn->prepare("INSERT INTO data_mobil (nama, nomor_polisi, merk, jenis_mobil, foto, harga_rental_12jam, harga_rental_24jam) values (?,?,?,?,?,?,?)");
        $stmt->bind_param(
            "sssssii",
            $nama, 
            $nomor_polisi, 
            $merk, 
            $jenis_mobil, 
            $foto_mobil_path, 
            $harga_rental_12jam, 
            $harga_rental_24jam
        );
        $stmt->execute();
    }

    function editMobil($id, $nama, $nomor_polisi, $merk, $jenis_mobil, $foto, $harga_rental_12jam, $harga_rental_24jam)
    {
        if ($foto["tmp_name"] != null)
        {
            $foto_mobil_path = "fotomobil_".strval(rand(0,1000000)).$foto["name"];
            move_uploaded_file($foto["tmp_name"],"foto_mobil/$foto_mobil_path");
            $stmt = $this->conn->prepare("UPDATE data_mobil SET nama=?, nomor_polisi=?,merk=?,jenis_mobil=?,foto=?,harga_rental_12jam=?,harga_rental_24jam=? WHERE id = ?");
            $stmt->bind_param(
                "sssssiii",
                $nama, 
                $nomor_polisi, 
                $merk, 
                $jenis_mobil, 
                $foto_mobil_path, 
                $harga_rental_12jam, 
                $harga_rental_24jam,
                $id
            );
            $stmt->execute();
        }
        else 
        {
            $stmt = $this->conn->prepare("UPDATE data_mobil SET nama=?, nomor_polisi=?,merk=?,jenis_mobil=?,harga_rental_12jam=?,harga_rental_24jam=? WHERE id = ?");
            $stmt->bind_param(
                "ssssiii",
                $nama, 
                $nomor_polisi, 
                $merk, 
                $jenis_mobil,
                $harga_rental_12jam, 
                $harga_rental_24jam,
                $id
            );
            $stmt->execute();
        }
    }

    function deleteMobil($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM data_mobil WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }
}  

class Rental
{
    private $conn;
    private $idacc;
    private $username;
    private $waktu_rental;
    private $tanggal_rental;
    private $total_harga;
    private $keterangan;

    function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function setIdAcc($idacc)
    {
        $this->idacc = $idacc;
    }

    function getIdAcc()
    {
        return $this->idacc;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setWaktuRental($waktu_rental)
    {
        $this->waktu_rental = $waktu_rental;
    }

    function getWaktuRental()
    {
        return $this->waktu_rental;
    }

    function setTanggalRental($tanggal_rental)
    {
        $this->tanggal_rental = $tanggal_rental;
    }

    function getTanggalRental()
    {
        return $this->tanggal_rental;
    }

    function setTotalHarga($total_harga)
    {
        $this->total_harga = $total_harga;
    }

    function getTotalHarga()
    {
        return $this->total_harga;
    }

    function setKeterangan($keterangan)
    {
        $this->keterangan = $keterangan;
    }

    function getKeterangan()
    {
        return $this->keterangan;
    }

    function tambahKeDB()
    {
        $stmt = $this->conn->prepare("INSERT INTO data_rental (id_acc,username,waktu_rental,tanggal_rental,total_harga,keterangan) values (?,?,?,?,?,?)");
        $stmt->bind_param("isssis",$this->idacc,$this->username,$this->waktu_rental,$this->tanggal_rental,$this->total_harga,$this->keterangan);
        $stmt->execute();
    }

    function getDataFromIdDB($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM data_rental WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        $this->idacc = $data["id_acc"];
        $this->username = $data["username"];
        $this->waktu_rental = $data["waktu_rental"];
        $this->tanggal_rental = $data["tanggal_rental"];
        $this->total_harga = $data["total_harga"];
        $this->keterangan = $data["keterangan"];
    }
}