<?php
session_start();
include 'index.php';

if($_SESSION['status_login']!=true){    /*supaya admin gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
$absensi = mysqli_query($koneksi, "SELECT * from absensi where id_absensi = '" . $_GET['id'] . "'");
if (mysqli_num_rows($absensi) == 0) {
    echo '<script>window.location="data_absensi.php"</script>';
}
$abs = mysqli_fetch_object($absensi);

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
            <h1><a href="dashboard.php"><img src="img/logo_unpad.png" alt="Logo Unpad" class="img-fluid""></a></h1>
            <ul>
            <li><a href=" dashboard.php">Dashboard</a></li>
                <li><a>|</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a>|</a></li>
                <li><a href="data_mhs.php">Data Mahasiswa</a></li>
                <li><a>|</a></li>
                <li><a href="data_matkul.php">Mata Kuliah</a></li>
                <li><a>|</a></li>
                <li><a href="data_absensi.php">Absensi</a></li>
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
            <h3>Edit Data Absensi</h3>
            <div class="box">
                <form action="" method="POST">
                    <p>
                    <div class="btn3"><a href="data_absensi.php">Kembali</a></div>
                    </p>
                    <input type="text" name="id" placeholder="ID Absensi" class="input-control" value="<?php echo $abs->id_absensi ?>" readonly>
                    <input type="text" name="nip_dosen" placeholder="NIP Dosen" class="input-control" value="<?php echo $abs->nip_dosen ?>" readonly>
                    <input type="text" name="npm_dosen" placeholder="NPM Mahasiswa" class="input-control" value="<?php echo $abs->npm_mhs ?>" readonly>
                    <input type="text" name="kode_matkul" placeholder="Kode Matkul" class="input-control" value="<?php echo $abs->kode_matkul ?>" readonly>
                    <input type="text" name="media_belajar" placeholder="Media Belajar" class="input-control" value="<?php echo $abs->media_bljr ?>" required>
                    <input type="text" name="materi_belajar" placeholder="Materi Belajar" class="input-control" value="<?php echo $abs->materi_bljr ?>" required>
                    <input type="text" name="status_absensi" placeholder="Status Absensi" class="input-control" value="<?php echo $abs->status_absensi ?>" required>
                    <input type="text" name="tgl_absensi" placeholder="Tanggal Absensi (YYYY-MM-DD)" class="input-control" value="<?php echo $abs->tgl_absensi ?>" required>
                    <input type="submit" name="update_absensi" value="Update Absensi" class="btn">
                </form>
                <?php
                if (isset($_POST['update_absensi'])) {
                    $media_belajar = ucwords($_POST['media_belajar']);
                    $materi_belajar = ucwords($_POST['materi_belajar']);
                    $status = ucwords($_POST['status_absensi']);
                    $tgl_absensi = ($_POST['tgl_absensi']);

                    $update = mysqli_query($koneksi, "UPDATE absensi SET media_bljr='" . $media_belajar . "', materi_bljr='" . $materi_belajar . "', status_absensi='" . $status . "', tgl_absensi='" . $tgl_absensi . "'  where id_absensi='" . $abs->id_absensi . "'");
                    if ($update) {
                        echo '<script>alert("Data berhasil diperbarui!")</script>';
                        echo '<script>window.location="data_absensi.php"</script>';
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