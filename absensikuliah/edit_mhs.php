<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_adm'] != true) {    /*supaya gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
$mhs = mysqli_query($koneksi, "SELECT * from mahasiswa where npm_mhs = '" . $_GET['id'] . "'");
if (mysqli_num_rows($mhs) == 0) {
    echo '<script>window.location="data_mhs_adm.php"</script>';
}
$mahasiswa = mysqli_fetch_object($mhs);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
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
            <h3>Edit Data Absensi</h3>
            <div class="box">
                <form action="" method="POST">
                    <p>
                    <div class="btn3"><a href="data_mhs_adm.php">Kembali</a></div>
                    </p>                    
                    <input type="text" name="nip_dosen" placeholder="NIP Dosen" class="input-control" value="<?php echo $mahasiswa->nip_dosen ?>" required>
                    <input type="text" name="npm_mhs" placeholder="NPM Mahasiswa" class="input-control" value="<?php echo $mahasiswa->npm_mhs ?>" readonly>
                    <input type="text" name="nama_mhs" placeholder="Nama Mahasiswa" class="input-control" value="<?php echo $mahasiswa->$nama_mhs ?>" required>
                    <input type="text" name="jk_mhs" placeholder="Jenis Kelamin (L/P)" class="input-control" value="<?php echo $mahasiswa->jk_mhs ?>" required>
                    <input type="text" name="thn_angkatan" placeholder="Tahun Angkatan (20XX)" class="input-control" value="<?php echo $mahasiswa->thn_angkatan ?>" required>
                    <input type="text" name="kode_fakultas" placeholder="Kode Fakultas" class="input-control" value="<?php echo $mahasiswa->kode_fakultas ?>" required>
                    <input type="text" name="kode_prodi" placeholder="Kode Program Studi" class="input-control" value="<?php echo $mahasiswa->kode_prodi ?>" required>
                    <input type="text" name="kelas" placeholder="Kelas" class="input-control" value="<?php echo $mahasiswa->kelas_mhs ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $mahasiswa->email_mhs ?>" required>
                    <input type="text" name="telp_mhs" placeholder="No. HP" class="input-control" value="<?php echo $mahasiswa->telp_mhs ?>" required>
                    <input type="text" name="alamat_mhs" placeholder="Alamat Mahasiswa" class="input-control" value="<?php echo $mahasiswa->alamat_mhs ?>" required>
                    <input type="submit" name="edit_mhs" value="Edit Mahasiswa" class="btn" onclick="return confirm('Yakin ingin ubah data?')">
                </form>
                <?php
                if (isset($_POST['edit_mhs'])) {
                    $nip_dosen = $_POST['nip_dosen'];
                    $nama_mhs = ucwords($_POST['nama_mhs']);
                    $jk_mhs = $_POST['jk_mhs'];
                    $thn_angkatan = $_POST['thn_angkatan'];
                    $kode_fakultas = ucwords($_POST['kode_fakultas']);
                    $kode_prodi = ucwords($_POST['kode_prodi']);
                    $kelas = ucwords($_POST['kelas']);
                    $email_mhs = $_POST['email'];
                    $telp_mhs = $_POST['telp_mhs'];
                    $alamat_mhs = ucwords($_POST['alamat_mhs']);

                    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET  nip_dosen='" . $nip_dosen . "',
                                                                            nama_mhs ='" . $nama_mhs . "',
                                                                            jk_mhs ='" . $jk_mhs . "',
                                                                            thn_angkatan ='" . $thn_angkatan . "',
                                                                            kode_fakultas ='" . $kode_fakultas . "',
                                                                            kode_prodi ='" . $kode_prodi . "',
                                                                            kelas_mhs ='" . $kelas . "',
                                                                            email_mhs ='" . $email_mhs . "',
                                                                            telp_mhs ='" . $telp_mhs . "',
                                                                            alamat_mhs ='" . $alamat_mhs . "',
                                                                            where npm_mhs='" . $mahasiswa->npm_mhs . "'");
                    if ($update) {
                        echo '<script>alert("Data berhasil diperbarui!")</script>';
                        echo '<script>window.location="data_mhs_adm.php"</script>';
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