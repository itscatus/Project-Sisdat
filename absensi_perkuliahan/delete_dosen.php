<?php
include 'index.php';
if(isset($_GET['del_id'])){
    $delete = mysqli_query($koneksi, "DELETE from dosen where npm_dosen = '".$_GET['del_id']."'");
    echo '<script>window.location="data_dosen_adm.php"</script>';
}
?>