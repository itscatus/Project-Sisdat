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
    <title>Data Absensi</title>
    <link rel="stylesheet" type="text/css" href="css/style_data.css">
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
            <h3>Absensi Perkuliahan</h3>
            <div class="box">
                <p>
                <div class="btn3"><a href="update_absensi_adm.php">Tambah Data</a></div>
                </p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="40px">No.</th>
                            <th width="125px">ID Absen</th>
                            <th width="95px">Tanggal</th>
                            <th width="140px">Nama Matkul</th>
                            <th width="110px">Media Belajar</th>
                            <th width="120px">Materi</th>
                            <th width="125px">NPM Mahasiswa</th>
                            <th width="150px">Nama Mahasiswa</th>
                            <th width="130px">Kehadiran</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $absensi = mysqli_query($koneksi, "SELECT * from absensi join perkuliahan join mahasiswa where absensi.kode_matkul = perkuliahan.kode_matkul and absensi.npm_mhs=mahasiswa.npm_mhs order by id_absensi desc");
                        $hadir = mysqli_query($koneksi, "SELECT * from absensi where status_absensi='Hadir'");
                        $dtg = mysqli_fetch_array($hadir);
                        if (mysqli_num_rows($absensi) > 0) {
                            while ($row = mysqli_fetch_array($absensi)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?>.</td>
                                    <td><?php echo $row['id_absensi'] ?></td>
                                    <td><?php echo $row['tgl_absensi'] ?></td>
                                    <td><?php echo $row['nama_matkul'] ?></td>
                                    <td><?php echo $row['media_bljr'] ?></td>
                                    <td><?php echo $row['materi_bljr'] ?></td>
                                    <td><?php echo $row['npm_mhs'] ?></td>
                                    <td><?php echo $row['nama_mhs'] ?></td>
                                    <td width="120px">
                                        <?php
                                        if (mysqli_num_rows($hadir) == 0 || $row['status_absensi'] != $dtg['status_absensi']) {
                                        ?>
                                            <a href="edit_absensi.php?id=<?php echo $row['id_absensi'] ?>">
                                                <div class="btn2"><?php echo $row['status_absensi'] ?></div>
                                            </a>
                                        <?php } else {
                                        ?>
                                            <a href="edit_absensi.php?id=<?php echo $row['id_absensi'] ?>">
                                                <div class="btn"><?php echo $row['status_absensi'] ?></div>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td width="120px"><a href="edit_absensi_adm.php?id=<?php echo $row['id_absensi'] ?>">
                                            <div class="btn">Edit</div><a href="delete_absensi_adm.php?del_id=<?php echo $row['id_absensi'] ?>" onclick="return confirm('Data yang telah dihapus tidak dapat dikembalikan. Yakin ingin menghapus?')">
                                                <div class="btn2">Hapus</div>
                                            </a>
                                        </a></td>
                                </tr>
                            <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="10">Tidak ada data</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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