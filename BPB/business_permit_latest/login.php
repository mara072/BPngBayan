<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Permit | Login</title>
<link rel="shortcut icon" type="image/x-icon" href="dist/img/logo.png">
<link rel="stylesheet" href="dist/css/font.css">

<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="col-lg-12 col-md-12 col-sm-12">
  <p style="text-align: center;">
  <img src="dist/img/logo.png" style="height: 200px; width: 200px;">
  </p>
</div>
<div class="card card-outline card-primary">
<div class="card-header text-center">
<h3><b>Business <br>Permit System</b></h3>
</div>
<div class="card-body">
<p class="login-box-msg">Sign in to start your session</p>
<form action="process/login.php" method="POST">
<div class="input-group mb-3">
<input type="email" class="form-control" id="username" name="username" placeholder="Username" required autocomplete="off">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-user"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="off">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div> 
<div class="social-auth-links text-center mt-2 mb-3">
<button type="submit" class="btn btn-block btn-primary" name="login_btn"> Login 
<i class="far fa-arrow-alt-circle-right"></i>
</button>

<a href="signup.php" class="btn btn-block btn-secondary"> Signup 
<i class="fa fa-user-edit"></i>
</a>
</form>
</div>
</div>

</div>
</div>

</body>
</html>
