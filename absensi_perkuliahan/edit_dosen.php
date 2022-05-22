<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_adm'] != true) {    /*supaya gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
$dosen = mysqli_query($koneksi, "SELECT * from dosen join fakultas join program_studi where dosen.nip_dosen='" . $_GET['id'] . "'");
if (mysqli_num_rows($dosen) == 0) {
    echo '<script>window.location="data_dosen_adm.php"</script>';
}
$dsn = mysqli_fetch_object($dosen);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
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
            <h3>Edit Data Dosen</h3>
            <div class="box">
                <form action="" method="POST">
                    <p>
                    <div class="btn3"><a href="data_dosen_adm.php">Kembali</a></div>
                    </p>
                    <input type="text" name="nip_dosen" placeholder="NIP Dosen" class="input-control" value="<?php echo $dsn->nip_dosen ?>" readonly>
                    <input type="text" name="nama_dosen" placeholder="Nama Dosen" class="input-control" value="<?php echo $dsn->nama_dosen ?>" required>
                    <input type="text" name="gelar_dosen" placeholder="Gelar" class="input-control" value="<?php echo $dsn->gelar_dosen ?>" >
                    <input type="text" name="golongan" placeholder="Golongan" class="input-control" value="<?php echo $dsn->golongan ?>">
                    <input type="text" name="prodi" placeholder="Kode Program Studi" class="input-control" value="<?php echo $dsn->kode_prodi ?>" required>
                    <input type="text" name="fakultas" placeholder="Kode Fakultas" class="input-control" value="<?php echo $dsn->kode_fakultas ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $dsn->email_dosen ?>">
                    <input type="text" name="phone" placeholder="No. HP" class="input-control" value="<?php echo $dsn->telp_dosen?>" >
                    <input type="submit" name="edit_dosen" value="Edit Dosen" class="btn" onclick="return confirm('Yakin ingin ubah data?')">
                </form>
                <?php
                if (isset($_POST['edit_dosen'])) {
                    $nama_dosen = ucwords($_POST['nama_dosen']);
                    $gelar = $_POST['gelar_dosen'];
                    $golongan = $_POST['golongan'];
                    $prodi = $_POST['prodi'];
                    $fakultas = $_POST['fakultas'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];

                    $update = mysqli_query($koneksi, "UPDATE perkuliahan SET nama_dosen ='" . $nama_dosen . "',
                                                                             gelar_dosen ='" . $gelar . "', 
                                                                             golongan ='" . $golongan . "',
                                                                             kode_prodi='" . $prodi . "', 
                                                                             kode_fakultas='" . $fakultas . "', 
                                                                             email_dosen='" . $email . "', 
                                                                             telp_dosen='" . $telp . "'
                                                                             where nip_dosen='" . $dsn->nip_dosen . "'");
                    if ($update) {
                        echo '<script>alert("Data berhasil diperbarui!")</script>';
                        echo '<script>window.location="data_dosen_adm.php"</script>';
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