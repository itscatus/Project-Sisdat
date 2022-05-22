<?php
    session_start();
    include 'index.php';

    if($_SESSION['status_login_adm']!=true){    /*supaya admin gabisa akses sblm login*/
        echo '<script>window.location="login.php"</script>';
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Absensi</title>
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
                <li><a href="logout.php"><div class="btn">Logout</div></a></li>
            </ul>
        </div>
    </header>

    <!--content-->
    <div class="section">
        <div class="container2">
            <h3>Update Data Absensi</h3>
            <div class="box">
                <p><div class="btn3"><a href="data_absensi_adm.php">Kembali</a></div></p>
                <form action="" method="POST">
                    <input type="text" name="id" placeholder="ID Absensi (YYMMDD-2 digit Jml Pertemuan-6 digit terakhir NPM mhs)" class="input-control" required>
                    <input type="text" name="nip_dosen" placeholder="NIP Dosen" class="input-control" required>
                    <input type="text" name="npm_mhs" placeholder="NPM Mahasiswa" class="input-control" required>
                    <input type="text" name="kode_matkul" placeholder="Kode Matkul" class="input-control" required>
                    <input type="text" name="media_belajar" placeholder="Media Belajar" class="input-control" required>
                    <input type="text" name="materi_belajar" placeholder="Materi Belajar" class="input-control" required>
                    <input type="text" name="status_absensi" placeholder="Status Absensi" class="input-control">
                    <input type="text" name="tgl_absensi" placeholder="Tanggal Absensi (YYYY-MM-DD)" class="input-control" required>
                    <input type="text" name="start" placeholder="Jam Mulai (HH:MM:SS)" class="input-control" required>
                    <input type="text" name="fin" placeholder="Jam Selesai (HH:MM:SS)" class="input-control" required>
                    <input type="submit" name="update_absensi" value="Update Absensi" class="btn">
                </form>
                <?php
                    if(isset($_POST['update_absensi'])){
                        $id = $_POST['id'];
                        $nip_dosen = $_POST['nip_dosen'];
                        $npm_mhs = $_POST['npm_mhs'];
                        $kode_matkul = $_POST['kode_matkul'];
                        $media_belajar = ucwords($_POST['media_belajar']);
                        $materi_belajar = ucwords($_POST['materi_belajar']);
                        $status = ucwords($_POST['status_absensi']);
                        $tgl_absensi = $_POST['tgl_absensi'];
                        $jam_mulai = $_POST['start'];
                        $jam_selesai = $_POST['fin'];

                        $insert = mysqli_query($koneksi, "INSERT into absensi VALUES ('".$id."','".$nip_dosen."','".$npm_mhs."','".$kode_matkul."','".$media_belajar."','".$materi_belajar."','".$status."','".$tgl_absensi."','".$jam_mulai."','".$jam_selesai."')");
                        if($insert){
                            echo '<script>alert("Data berhasil ditambahkan!")</script>>';
                            echo '<script>window.location="data_absensi_adm.php"</script>';
                        }
                        else{
                            echo 'Data gagal ditambahkan!'.mysqli_error($koneksi);
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