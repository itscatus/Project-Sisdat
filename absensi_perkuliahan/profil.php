<?php
session_start();
include 'index.php';

if ($_SESSION['status_login'] != true) {    /*supaya admin gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nip_dosen = '" . $_SESSION['id'] . "'");
$data = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="css/style_profil.css">
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
            <h3>Update Profil Dosen</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama" class="input-control" value="<?php echo $data->nama_dosen ?>" required>
                    <input type="text" name="nip" placeholder="NIP" class="input-control" value="<?php echo $data->nip_dosen ?>" readonly>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $data->email_dosen ?>">
                    <input type="text" name="phone" placeholder="No. HP" class="input-control" value="<?php echo $data->telp_dosen ?>">
                    <input type="submit" name="update_profil" value="Update Profil" class="btn">
                </form>
                <?php
                if (isset($_POST['update_profil'])) {
                    $nama   = ucwords($_POST['nama']);
                    $email  = $_POST['email'];
                    $phone  = $_POST['phone'];

                    $update = mysqli_query($koneksi, "UPDATE dosen SET  nama_dosen = '" . $nama . "',
                                                                            email_dosen = '" . $email . "',
                                                                            telp_dosen = '" . $phone . "'
                                                                            WHERE nip_dosen = '" . $data->nip_dosen . "' ");
                    if ($update) {
                        echo '<script>alert("Profil berhasil diperbarui!")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    } else {
                        echo 'Gagal memperbarui Profil!' . mysqli_error($koneksi);
                    }
                }
                ?>
            </div>
        </div>
        <div class="container3">
            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="newpass" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="confpass" placeholder="Konfirmasi Password" class="input-control" required>
                    <input type="submit" name="update_password" value="Update Password" class="btn">
                </form>
                <?php
                if (isset($_POST['update_password'])) {
                    $newpass    = $_POST['newpass'];
                    $confpass   = $_POST['confpass'];

                    if ($confpass != $newpass) {
                        echo '<script>alert("Password tidak sesuai!")</script>';
                    } else {
                        $update = mysqli_query($koneksi, "UPDATE dosen SET password = '" . MD5($newpass) . "' WHERE nip_dosen = '" . $data->nip_dosen . "' ");
                        if ($update) {
                            echo '<script>alert("Password berhasil diperbarui!")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else {
                            echo 'Gagal memperbarui Password!' . mysqli_error($koneksi);
                        }
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