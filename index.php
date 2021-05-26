<?php
	//Koneksi Database
	session_start();
	require 'koneksi.php';
	// error_reporting(0);
	//jika tombol simpan diklik

	if($_SESSION['status'] != "login")
	{
		echo "<script>
		alert('Anda Harus Login!!!');window.location.href='login.php';
		</script>";
	}

	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			@$edit = mysqli_query($koneksi, "UPDATE tb_mahasiswa set
											 	nim = '$_POST[nim]',
											 	nama = '$_POST[nama]',
												alamat = '$_POST[alamat]',
											 	program_studi = '$_POST[prodi]'
											 WHERE id = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='index.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='index.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO tb_mahasiswa (nim, nama, alamat, program_studi)
										  VALUES ('$_POST[nim]', 
										  		 '$_POST[nama]', 
										  		 '$_POST[alamat]', 
										  		 '$_POST[prodi]')
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='index.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='index.php';
				     </script>";
			}
		}


		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$vnim = $data['nim'];
				$vnama = $data['nama'];
				$valamat = $data['alamat'];
				$vprodi = $data['program_studi'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE id = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='index.php';
				     </script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SI - Mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="asset/font/css/fontawesome.min.css">
	<link rel="stylesheet" href="asset/font/css/all.min.css">
	<link rel="icon" href="asset/img/icon.png">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand">SI - Mahasiswa</a>
  <a class="nav-item" href="logout.php" style="color:white"><i class="fa fa-sign-out-alt"></i> Logout</a>
</nav>
<div class="container-fluid mt-3">
	<h3>Selamat Datang, <?= $_SESSION['nickname']; ?>!</h3>
</div>
<div class="container-fluid">
	<div class="row">
	<!-- Awal Card Form -->
	<div class="col-md-auto">
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Mahasiswa
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>Nim</label>
	    		<input type="text" name="nim" value="<?=@$vnim?>" class="form-control" placeholder="Input Nim..." required>
	    	</div>
	    	<div class="form-group">
	    		<label>Nama</label>
	    		<input type="text" name="nama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama..." required>
	    	</div>
	    	<div class="form-group">
	    		<label>Alamat</label>
	    		<textarea class="form-control" name="alamat"  placeholder="Input Alamat..."><?=@$valamat?></textarea>
	    	</div>
	    	<div class="form-group">
	    		<label>Program Studi</label>
	    		<select class="form-control" name="prodi">
	    			<option value="<?=@$vprodi?>"><?=@$vprodi?></option>
	    			<option value="D3 - MI">D3 - MI</option>
	    			<option value="S1 - SI">S1 - SI</option>
	    			<option value="S1 - TI">S1 - TI</option>
	    		</select>
	    	</div>

	    	<button type="submit" class="btn btn-success" name="bsimpan"><i class="fa fa-save"></i> Save</button>
	    	<button type="reset" class="btn btn-danger" name="breset"><i class="fa fa-trash-restore"></i> Clear</button>

	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form -->
	</div>
	<!-- Awal Card Tabel -->
	<div class="col-sm">
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Mahasiswa
	  </div>
	  <div class="card-body">
	    
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<th>No.</th>
	    		<th>Nim</th>
	    		<th>Nama</th>
	    		<th>Alamat</th>
	    		<th>Program Studi</th>
	    		<th>Aksi</th>
	    	</tr>
	    	<?php
	    		$no = 1;
	    		$tampil = mysqli_query($koneksi, "SELECT * from tb_mahasiswa order by id desc");
	    		while($data = mysqli_fetch_array($tampil)) :

	    	?>
	    	<tr>
	    		<td><?=$no++;?></td>
	    		<td><?=$data['nim']?></td>
	    		<td><?=$data['nama']?></td>
	    		<td><?=$data['alamat']?></td>
	    		<td><?=$data['program_studi']?></td>
	    		<td>
	    			<a href="index.php?hal=edit&id=<?=$data['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit </a>
	    			<a href="index.php?hal=hapus&id=<?=$data['id']?>" 
	    			   onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Hapus</a>
	    		</td>
	    	</tr>
	    <?php endwhile; //penutup perulangan while ?>
	    </table>

	  </div>
	</div>
	<!-- Akhir Card Tabel -->
	</div>
	</div>
</div>

<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
</body>
</html>