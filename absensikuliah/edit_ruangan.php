<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_adm'] != true) {    /*supaya gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
$ruang = mysqli_query($koneksi, "SELECT * from perkuliahan join dosen where perkuliahan.nip_dosen = dosen.nip_dosen and kode_ruangan = '" . $_GET['id'] . "'");
if (mysqli_num_rows($ruang) == 0) {
    echo '<script>window.location="data_absensi.php"</script>';
}
$rk = mysqli_fetch_object($ruang);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Ruangan</title>
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
            <h3>Edit Data Ruangan</h3>
            <div class="box">
                <form action="" method="POST">
                    <p>
                    <div class="btn3"><a href="data_ruangan_adm.php">Kembali</a></div>
                    </p>
                    <input type="text" name="kode_ruangan" placeholder="Kode Ruangan" class="input-control" value="<?php echo $rk->kode_ruangan ?>" readonly>
                    <input type="text" name="lokasi_ruangan" placeholder="Lokasi Ruangan" class="input-control" value="<?php echo $rk->lokasi_ruangan ?>" required>
                    <input type="text" name="kapasitas" placeholder="Kapasitas" class="input-control" value="<?php echo $rk->kapasitas ?>" required>
                    <input type="submit" name="edit_ruangan" value="Edit Ruangan" class="btn" onclick="return confirm('Yakin ingin ubah data?')">
                </form>
                <?php
                if (isset($_POST['edit_ruangan'])) {
                    $lokasi_ruangan = $_POST['lokasi_ruangan'];
                    $kapasitas = ucwords($_POST['kapasitas']);

                    $update = mysqli_query($koneksi, "UPDATE perkuliahan SET    lokasi_ruangan = '" . $lokasi_ruangan . "',
                                                                                kapasitas = '" . $kapasitas . "'
                                                                                where kode_ruangan='" . $rk->kode_ruangan . "'");
                    if ($update) {
                        echo '<script>alert("Data berhasil diperbarui!")</script>';
                        echo '<script>window.location="data_ruangan_adm.php"</script>';
                    } else {
                        echo 'Data gagal diperbarui!' . mysqli_error($koneksi);
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