<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_adm'] != true) {    /*supaya gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mata Kuliah</title>
    <link rel="stylesheet" type="text/css" href="css/style_update.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>

<body>
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="dashboard_adm.php"><img src="img/logo_unpad.png" alt="Logo Unpad" class="img-fluid""></a></h1>
            <ul>
            <li><a href="dashboard_adm.php">Dashboard</a></li>
                <li><a>|</a></li>
                <li><a href="profil_adm.php">Profil</a></li>
                <li><a>|</a></li>
                <li><a href="data_dosen_adm.php">Dosen</a></li>
                <li><a>|</a></li>
                <li><a href="data_mhs_adm.php">Mahasiswa</a></li>
                <li><a>|</a></li>
                <li><a href="data_matkul_adm.php">Mata Kuliah</a></li>
                <li><a>|</a></li>
                <li><a href="data_ruangan_adm.php">Ruangan</a></li>
                <li><a>|</a></li>
                <li><a href="data_absensi_adm.php">Absensi</a></li>
                <li><a>|</a></li>
                <li><a href="logout.php">
                        <div class="btn">Logout</div>
                    </a></li>
                </ul>
        </div>
    </header>

    <!--content-->
    <div class="section">
        <div class="container2">
            <h3>Update Data Mata Kuliah</h3>
            <div class="box">
                <p>
                <div class="btn3"><a href="data_matkul_adm.php">Kembali</a></div>
                </p>
                <form action="" method="POST">
                    <input type="text" name="kode_matkul" placeholder="Kode Matkul" class="input-control" required>
                    <input type="text" name="nip_dosen" placeholder="NIP Dosen" class="input-control" required>
                    <input type="text" name="npm_mhs" placeholder="NPM Mahasiswa" class="input-control" required>
                    <input type="text" name="kode_ruangan" placeholder="Kode Ruangan" class="input-control" required>
                    <input type="text" name="nama_matkul" placeholder="Nama Mata Kuliah" class="input-control" required>
                    <input type="text" name="jml_sks" placeholder="Jumlah SKS" class="input-control" required>
                    <input type="text" name="semester" placeholder="Semester (angka-Ganjil/Genap)" class="input-control" required>
                    <input type="text" name="thn_akademik" placeholder="Tahun Akademik (20XX)" class="input-control" required>
                    <input type="text" name="jadwal_kuliah" placeholder="Jadwal Kuliah (Hari, jam mulai - jamselesai)" class="input-control" required>
                    <input type="submit" name="update_matkul" value="Update Matkul" class="btn">
                </form>
                <?php
                if (isset($_POST['update_matkul'])) {
                    $nip_dosen = $_POST['nip_dosen'];
                    $npm_mhs = $_POST['npm_mhs'];
                    $kode_matkul = $_POST['kode_matkul'];
                    $kode_ruangan = $_POST['kode_ruangan'];
                    $nama_matkul = $_POST['nama_matkul'];
                    $jml_sks = ucwords($_POST['jml_sks']);
                    $semester = ucwords($_POST['semester']);
                    $thn_akademik = ucwords($_POST['thn_akademik']);
                    $jadwal_kuliah = ($_POST['jadwal_kuliah']);

                    $insert = mysqli_query($koneksi, "INSERT into perkuliahan VALUES '" . $kode_matkul . "','" . $nip_dosen . "','" . $npm_mhs . "','" . $kode_ruangan . "','" . $nama_matkul . "','" . $jml_sks . "','" . $semester . "','" . $thn_akademik . "','".$jadwal_kuliah."'");
                    if ($insert) {
                        echo '<script>alert("Data berhasil ditambahkan!")</script>>';
                        echo '<script>window.location="data_matkul_adm.php"</script>';
                    } else {
                        echo 'Data gagal ditambahkan!' . mysqli_error($koneksi);
                    }
                }
                ?>
            </div>
        </div>
        <div class="container3">

        </div>
    </div>

    <!--footer-->
    <footer>
        <div class="container"></div>
        <small>Copyright &copy; 2022 - Kelompok 8 Project UAS Praktikum Sistem Database I 2022</small>
    </footer>
</body>

</html>