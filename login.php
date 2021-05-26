<?php
session_start();
require 'koneksi.php';

if(isset($_POST['submit'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    // menyeleksi data admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE username='$user' and password='$pass'");
 
    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($data);
    $raw = mysqli_fetch_array($data);
    if($cek > 0){
        $_SESSION['nickname'] = $raw['nickname'];
        $_SESSION['status'] = "login";
        header("location:index.php");
    }else{
        echo "<script>alert('Username atau Password Invalid');window.location.href='login.php';
        </script>";
    }

}



?>


<!DOCTYPE html>
<html>
<head>
	<title>Login SI-Mahasiswa</title>
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
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method="post">
              <div class="form-label-group">
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                <label for="inputUsername">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <!-- <div class="custom-control custom-checkbox mb-3"> -->
                <p>You don't have an account yet? <a href="register.php">Sign Up!</a></p>
              <!-- </div> -->
              <input class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" value="Sign In" type="submit">
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