<?php
include 'index.php';
if(isset($_GET['del_id'])){
    $delete = mysqli_query($koneksi, "DELETE from mahasiswa where npm_mhs = '".$_GET['del_id']."'");
    echo '<script>window.location="data_mhs_adm.php"</script>';
}
?>