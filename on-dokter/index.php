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
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dokter <?=$_SESSION['nama'];?></title>

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
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Data Pasien</h2>
			<hr />
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				$nik = $_GET['nik'];
				$cek = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM karyawan WHERE nik='$nik'");
					if($delete){
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
					}
				}
			}
			?>
			
			
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>Nik</th>
					<th>Nama Depan</th>
                    <th>Nama Belakang</th>
					<th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>	
				</tr>
				<?php
				$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE level_user='member' ORDER BY nik ASC");
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td><a href="profile.php?nik='.$row['nama'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nik'].'</a></td>
							<td>'.$row['nama'].'</td>
                            <td>'.$row['lastname'].'</td>
                            <td>'.$row['tempat_lahir'].'</td>
                            <td>'.$row['tanggal_lahir'].'</td>
							<td>';
							

						$no++;
					}
				
				?>
			</table>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>