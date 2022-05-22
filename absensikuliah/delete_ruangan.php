<?php
include 'index.php';
if(isset($_GET['del_id'])){
    $delete = mysqli_query($koneksi, "DELETE from ruangan where kode_ruangan = '".$_GET['del_id']."'");
    echo '<script>window.location="data_ruangan_adm.php"</script>';
}
?>