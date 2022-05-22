<?php
include 'index.php';
if(isset($_GET['del_id'])){
    $delete = mysqli_query($koneksi, "DELETE from absensi where id_absensi = '".$_GET['del_id']."'");
    echo '<script>window.location="data_absensi_adm.php"</script>';
}
?>