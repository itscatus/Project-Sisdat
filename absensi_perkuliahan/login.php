<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css">
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
				<li><a href=" login.php">
					<div class="btn">Login</div>
				</a></li>
				</ul>
		</div>
	</header>

	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn2">
		</form>
		<?php
		if (isset($_POST['submit'])) {
			session_start();
			include 'index.php';

			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$cekdosen = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nip_dosen = '" . $user . "' AND password = '" . MD5($pass) . "'");
			$cekmhs = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm_mhs = '" . $user . "' AND password = '" . MD5($pass) . "'");
			$cekadm = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin = '" . $user . "' AND password = '" . MD5($pass) . "'");

			if (mysqli_num_rows($cekdosen) > 0) {
				$data = mysqli_fetch_object($cekdosen);
				$_SESSION['status_login'] = true;
				$_SESSION['dosen_global'] = $data;
				$_SESSION['id'] = $data->nip_dosen;
				echo '<script>window.location="dashboard.php"</script>';	/*untuk lanjut ke dashboard*/
			} elseif (mysqli_num_rows($cekmhs) > 0) {
				$data = mysqli_fetch_object($cekmhs);
				$_SESSION['status_login_mhs'] = true;
				$_SESSION['mhs_global'] = $data;
				$_SESSION['id_mhs'] = $data->npm_mhs;
				echo '<script>window.location="dashboard_mhs.php"</script>';	/*untuk lanjut ke dashboard*/
			} elseif (mysqli_num_rows($cekadm) > 0) {
				$data = mysqli_fetch_object($cekadm);
				$_SESSION['status_login_adm'] = true;
				$_SESSION['admin_global'] = $data;
				$_SESSION['id_adm'] = $data->id_admin;
				echo '<script>window.location="dashboard_adm.php"</script>';	/*untuk lanjut ke dashboard*/
			} 
			else {
				echo '<script>alert("Username atau Password anda salah!")</script>';	/*munculin notif gagal login*/
			}
		}
		?>
	</div>

	<footer>
		<div class="container"></div>
		<small>Copyright &copy; 2022 - Kelompok 8 Project UAS Praktikum Sistem Database I 2022</small>
	</footer>
</body>

</html>