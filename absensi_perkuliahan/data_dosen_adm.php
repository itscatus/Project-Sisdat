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
    <title>Data Dosen</title>
    <link rel="stylesheet" type="text/css" href="css/style_data.css">
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
            <h3>Data Dosen</h3>
            <div class="box">
                <p>
                <div class="btn3"><a href="update_dosen.php">Tambah Data</a></div>
                </p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="20px">No.</th>
                            <th>NIP Dosen</th>
                            <th width="150px">Nama Dosen</th>
                            <th>Gelar Dosen</th>
                            <th>Program Studi</th>
                            <th width="50px">Fakultas</th>
                            <th>Golongan</th>
                            <th width="140px">Email</th>
                            <th>No. HP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $dosen = mysqli_query($koneksi, "SELECT * from dosen left join program_studi on dosen.kode_prodi = program_studi.kode_prodi left join fakultas on program_studi.kode_fakultas = fakultas.kode_fakultas order by dosen.nip_dosen");
                        if (mysqli_num_rows($dosen) > 0) {
                            while ($row = mysqli_fetch_array($dosen)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?>.</td>
                                    <td><?php echo $row['nip_dosen'] ?></td>
                                    <td><?php echo $row['nama_dosen'] ?></td>
                                    <td><?php echo $row['gelar_dosen'] ?></td>
                                    <td><?php echo $row['nama_prodi'] ?></td>
                                    <td><?php echo $row['nama_fakultas'] ?></td>
                                    <td><?php echo $row['golongan'] ?></td>
                                    <td><?php echo $row['email_dosen'] ?></td>
                                    <td><?php echo $row['telp_dosen'] ?></td>
                                    <td width="120px"><a href="edit_dosen.php?id=<?php echo $row['nip_dosen'] ?>">
                                            <div class="btn">Edit</div><a href="delete_dosen.php?del_id=<?php echo $row['nip_dosen'] ?>" onclick="return confirm('Data yang telah dihapus tidak dapat dikembalikan. Yakin ingin menghapus?')">
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