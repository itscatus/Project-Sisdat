<?php
session_start();
include 'index.php';
if ($_SESSION['status_login'] != true) {    /*supaya admin gabisa akses sblm login*/
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah</title>
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
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a>|</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a>|</a></li>
                <li><a href="data_mhs.php">Data Mahasiswa</a></li>
                <li><a>|</a></li>
                <li><a href="data_matkul.php">Mata Kuliah</a></li>
                <li><a>|</a></li>
                <li><a href="data_absensi.php">Absensi</a></li>
                <li><a>|</a></li>
                <li><a href="logout.php"><div class="btn">Logout</div></a></li>
            </ul>
        </div>
    </header>

    <!--content-->
    <div class="section">
        <div class="container2">
            <h3>Data Mata Kuliah</h3>
            <div class="box">
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="40px">No.</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Jumlah SKS</th>
                            <th>Semester</th>
                            <th>Nama Dosen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $matkul = mysqli_query($koneksi, "SELECT * from perkuliahan join dosen where perkuliahan.nip_dosen = dosen.nip_dosen order by kode_matkul desc");
                        if(mysqli_num_rows($matkul)>0){
                        while ($row = mysqli_fetch_array($matkul)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?>.</td>
                                <td><?php echo $row['kode_matkul']?></td>
                                <td><?php echo $row['nama_matkul']?></td>
                                <td><?php echo $row['jml_sks']?></td>
                                <td><?php echo $row['semester']?></td>
                                <td><?php echo $row['nama_dosen']?></td>
                            </tr>
                        <?php
                        }}else{?>
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