<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_adm'] != true) {    /*supaya gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
$matkul = mysqli_query($koneksi, "SELECT * from perkuliahan join dosen where perkuliahan.nip_dosen = dosen.nip_dosen and kode_matkul = '" . $_GET['id'] . "'");
if (mysqli_num_rows($matkul) == 0) {
    echo '<script>window.location="data_absensi.php"</script>';
}
$mk = mysqli_fetch_object($matkul);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Absensi</title>
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
            <h3>Edit Data Matkul</h3>
            <div class="box">
                <form action="" method="POST">
                    <p>
                    <div class="btn3"><a href="data_matkul_adm.php">Kembali</a></div>
                    </p>
                    <input type="text" name="kode_matkul" placeholder="Kode Mata Kuliah" class="input-control" value="<?php echo $mk->kode_matkul ?>" readonly>
                    <input type="text" name="nama_matkul" placeholder="Nama Mata Kuliah" class="input-control" value="<?php echo $mk->nama_matkul ?>" required>
                    <input type="text" name="nip_dosen" placeholder="NIP Dosen" class="input-control" value="<?php echo $mk->nip_dosen ?>" required>
                    <input type="text" name="jml_sks" placeholder="Jumlah SKS" class="input-control" value="<?php echo $mk->jml_sks ?>" required>
                    <input type="text" name="semester" placeholder="Semester (Angka-Ganjil/Genap)" class="input-control" value="<?php echo $mk->semester ?>" required>
                    <input type="text" name="thn_akademik" placeholder="Tahun Akademik (20XX)" class="input-control" value="<?php echo $mk->thn_akademik ?>" required>
                    <input type="text" name="jadwal" placeholder="Jadwal Perkuliahan (Hari, jam mulai-jam selesai)" class="input-control" value="<?php echo $mk->jadwal_kuliah ?>" required>
                    <input type="submit" name="edit_matkul" value="Edit Matkul" class="btn" onclick="return confirm('Yakin ingin ubah data?')">
                </form>
                <?php
                if (isset($_POST['edit_matkul'])) {
                    $nama_matkul = $_POST['nama_matkul'];
                    $sks = ucwords($_POST['jml_sks']);
                    $semester = ucwords($_POST['semester']);
                    $nip_dosen = ucwords($_POST['nip_dosen']);
                    $thn_akademik = $_POST['thn_akademik'];
                    $jadwal = ucwords($_POST['jadwal']);

                    $update = mysqli_query($koneksi, "UPDATE perkuliahan SET    jml_sks='" . $sks . "', 
                                                                                semester='" . $semester . "', 
                                                                                nip_dosen ='" . $nip_dosen . "',
                                                                                nama_matkul = '" . $nama_matkul . "',
                                                                                thn_akademik = '" . $thn_akademik . "',
                                                                                jadwal_kuliah = '" . $jadwal . "'
                                                                                where kode_matkul='" . $mk->kode_matkul . "'");
                    if ($update) {
                        echo '<script>alert("Data berhasil diperbarui!")</script>';
                        echo '<script>window.location="data_matkul_adm.php"</script>';
                    } else {
                        echo 'Data gagal diperbarui!' . mysqli_error($koneksi);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer>
        <div class="container"></div>
        <small>Copyright &copy; 2022 - Kelompok 8 Project UAS Praktikum Sistem Database I 2022</small>
    </footer>
</body>

</html>