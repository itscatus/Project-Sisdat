<?php
session_start();
include 'index.php';
if ($_SESSION['status_login_adm'] != true) {    /*supaya admin gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
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
            <h3>Data Mahasiswa</h3>
            <div class="box">
                <p>
                <div class="btn3"><a href="update_mhs.php">Tambah Data</a></div>
                </p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="20px">No.</th>
                            <th width="30px">NPM Mahasiswa</th>
                            <th width="130px">Nama Mahasiswa</th>
                            <th width="80px">Jenis Kelamin</th>
                            <th width="80px">Tahun Angkatan</th>
                            <th width="140px">Fakultas</th>
                            <th width="120px">Program Studi</th>
                            <th width="50px">Kelas</th>
                            <th width="100px">No. HP</th>
                            <th width="150px">Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $mhs = mysqli_query($koneksi, "SELECT * from mahasiswa join program_studi join fakultas where mahasiswa.kode_prodi = program_studi.kode_prodi order by npm_mhs");
                        if (mysqli_num_rows($mhs) > 0) {
                            while ($row = mysqli_fetch_array($mhs)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?>.</td>
                                    <td><?php echo $row['npm_mhs'] ?></td>
                                    <td><?php echo $row['nama_mhs'] ?></td>
                                    <td><?php echo $row['jk_mhs'] ?></td>
                                    <td><?php echo $row['thn_angkatan'] ?></td>
                                    <td><?php echo $row['nama_fakultas'] ?></td>
                                    <td><?php echo $row['nama_prodi'] ?></td>
                                    <td><?php echo $row['kelas_mhs'] ?></td>
                                    <td><?php echo $row['telp_mhs'] ?></td>
                                    <td><?php echo $row['alamat_mhs'] ?></td>
                                    <td width="120px"><a href="edit_mhs.php?id=<?php echo $row['npm_mhs'] ?>">
                                            <div class="btn">Edit</div><a href="delete_mhs.php?del_id=<?php echo $row['npm_mhs'] ?>" onclick="return confirm('Data yang telah dihapus tidak dapat dikembalikan. Yakin ingin menghapus?')">
                                                <div class="btn2">Hapus</div>
                                            </a>
                                        </a></td>
                                </tr>
                            <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="11">Tidak ada data</td>
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