<?php
session_start();
include 'index.php';

if ($_SESSION['status_login_adm'] != true) {    /*supaya admin gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin = '" . $_SESSION['id_adm'] . "'");
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
            <h3>Update Profil Admin</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama" class="input-control" value="<?php echo $data->nama_admin ?>" required>
                    <input type="text" name="id" placeholder="ID Admin" class="input-control" value="<?php echo $data->id_admin ?>" readonly>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $data->email_admin ?>">
                    <input type="text" name="phone" placeholder="No. HP" class="input-control" value="<?php echo $data->telp_admin ?>">
                    <input type="text" name="address" placeholder="Alamat" class="input-control" value="<?php echo $data->alamat_admin ?>">
                    <input type="submit" name="update_profil" value="Update Profil" class="btn">
                </form>
                <?php
                if (isset($_POST['update_profil'])) {
                    $nama   = ucwords($_POST['nama']);
                    $email  = $_POST['email'];
                    $phone  = $_POST['phone'];
                    $address = ucwords($_POST['address']);

                    $update = mysqli_query($koneksi, "UPDATE admin SET  nama_admin = '" . $nama . "',
                                                                        email_admin = '" . $email . "',
                                                                        telp_admin = '" . $phone . "',
                                                                        alamat_admin = '".$address."'
                                                                        WHERE id_admin = '" . $data->id_admin . "' ");
                    if ($update) {
                        echo '<script>alert("Profil berhasil diperbarui!")</script>';
                        echo '<script>window.location="profil_adm.php"</script>';
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
                        $update = mysqli_query($koneksi, "UPDATE admin SET password = '" . MD5($newpass) . "' WHERE id_admin = '" . $data->id_admin . "' ");
                        if ($update) {
                            echo '<script>alert("Password berhasil diperbarui!")</script>';
                            echo '<script>window.location="profil_adm.php"</script>';
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