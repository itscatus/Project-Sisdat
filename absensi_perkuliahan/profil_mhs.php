<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_mhs'] != true) {    /*supaya gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa join fakultas join program_studi WHERE npm_mhs = '" . $_SESSION['id_mhs'] . "'");
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
            <h1><a href="dashboard_mhs.php"><img src="img/logo_unpad.png" alt="Logo Unpad" class="img-fluid""></a></h1>
            <ul>
                <li><a href=" dashboard_mhs.php">Dashboard</a></li>
                <li><a>|</a></li>
                <li><a href="profil_mhs.php">Profil</a></li>
                <li><a>|</a></li>
                <li><a href="data_matkul_mhs.php">Mata Kuliah</a></li>
                <li><a>|</a></li>
                <li><a href="data_absensi_mhs.php">Absensi</a></li>
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
            <h3>Update Profil Mahasiswa</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama" class="input-control" value="<?php echo $data->nama_mhs ?>" required>
                    <input type="text" name="npm" placeholder="NPM" class="input-control" value="<?php echo $data->npm_mhs ?>" readonly>
                    <input type="text" name="jk" placeholder="Jenis Kelamin" class="input-control" value="<?php echo $data->jk_mhs ?>" readonly>
                    <input type="text" name="angkatan" placeholder="Tahun Angkatan" class="input-control" value="<?php echo $data->thn_angkatan ?>" readonly>
                    <input type="text" name="prodi" placeholder="Program Studi" class="input-control" value="<?php echo $data->nama_prodi ?>" readonly>
                    <input type="text" name="fakultas" placeholder="Fakultas" class="input-control" value="<?php echo $data->nama_fakultas ?>" readonly>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $data->email_mhs ?>">
                    <input type="text" name="phone" placeholder="No. HP" class="input-control" value="<?php echo $data->telp_mhs ?>">
                    <input type="text" name="address" placeholder="Alamat" class="input-control" value="<?php echo $data->alamat_mhs ?>">
                    <input type="submit" name="update_profil" value="Update Profil" class="btn">
                </form>
                <?php
                if (isset($_POST['update_profil'])) {
                    $nama   = ucwords($_POST['nama']);
                    $email  = $_POST['email'];
                    $phone  = $_POST['phone'];
                    $address = ucwords($_POST['address']);

                    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET  nama_mhs = '" . $nama . "',
                                                                            email_mhs = '" . $email . "',
                                                                            telp_mhs = '" . $phone . "',
                                                                            alamat_mhs = '" . $address . "'
                                                                            WHERE npm_mhs = '" . $data->npm_mhs . "' ");
                    if ($update) {
                        echo '<script>alert("Profil berhasil diperbarui!")</script>';
                        echo '<script>window.location="profil_mhs.php"</script>';
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
                        $update = mysqli_query($koneksi, "UPDATE mahasiswa SET password = '" . MD5($newpass) . "' WHERE npm_mhs = '" . $data->npm_mhs . "' ");
                        if ($update) {
                            echo '<script>alert("Password berhasil diperbarui!")</script>';
                            echo '<script>window.location="profil_mhs.php"</script>';
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