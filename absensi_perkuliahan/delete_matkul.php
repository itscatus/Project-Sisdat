<?php
include 'index.php';
if(isset($_GET['del_id'])){
    $delete = mysqli_query($koneksi, "DELETE from perkuliahan where kode_matkul = '".$_GET['del_id']."'");
    echo '<script>window.location="data_matkul_adm.php"</script>';
}
?>