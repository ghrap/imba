<?php
session_start();
include("koneksi.php");
/**
 * Jika Tidak login atau sudah login tapi bukan sebagai admin
 * maka akan dibawa kembali kehalaman login atau menuju halaman yang seharusnya.
 */
if ( !isset($_SESSION['user_login']) || 
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'dokter' ) ) {

	header('location:./../login.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-block visible-sm-block" href="profile.php">Profil Saya</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="profile.php">Profil Saya</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Data Pasien</a></li>
					<li><a href="./../logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Profil</h2>
			<hr />
			
			<?php
			$nip = $_GET['nip'];
			
			$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE nip='$nip'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: profile.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">NIP</th>
					<td><?php echo $row['nip']; ?></td>
				</tr>
				<tr>
					<th>Nama Depan</th>
					<td><?php echo $row['nama']; ?></td>
				</tr>
				<tr>
					<th>Nama Belakang</th>
					<td><?php echo $row['lastname']; ?></td>
				</tr>
				<tr>
					<th>Tempat Lahir</th>
					<td><?php echo $row['tempat_lahir']; ?></td>
				</tr>
				<tr>
					<th>Tanggal Lahir</th>
					<td><?php echo $row['tanggal_lahir']; ?></td>
				</tr>
				<tr>
					<th>Username</th>
					<td><?php echo $row['username']; ?></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><?php echo $row['password']; ?></td>
				</tr>
			</table>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>