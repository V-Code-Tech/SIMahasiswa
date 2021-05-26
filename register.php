<?php
require 'koneksi.php';

if(isset($_POST['submit'])){
    $nick = $_POST['nickname'];
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    // menyeleksi data admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi,"INSERT INTO tb_user (nickname,username,password) VALUES('$nick','$user','$pass')");
    if($data)
    {
      echo "
      <script>
        alert('Registrasi Berhasil!!!');window.location.href='login.php';
		  </script>";
    }
    else
    {
      echo "
      <script>
        alert('Registrasi Gagal!!!');window.location.href='register.php';
		  </script>";
    }
    // menghitung jumlah data yang ditemukan
    

}



?>


<!DOCTYPE html>
<html>
<head>
	<title>Register SI-Mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/css/custom.css">
	<link rel="icon" href="asset/img/icon.png">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-4 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign Up</h5>
            <form class="form-signin" method="post">
                <div class="form-label-group">
                    <input type="text" name="nickname" id="inputNickname" class="form-control" placeholder="Nickname/Nama panggilan" required autofocus>
                    <label for="inputNickname">Nickname</label>
                </div>
            <div class="form-label-group">
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                <label for="inputUsername">Username</label>
            </div>
            <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>

                <p align="center" class="container">Already have an account? <a href="login.php">Sign In!</a></p>
            <input class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" value="Sign Up" type="submit">
              <!-- <hr class="my-4"> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>


<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>