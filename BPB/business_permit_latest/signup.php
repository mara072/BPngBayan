<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Signup Page</title>
<link rel="shortcut icon" type="image/x-icon" href="dist/img/logo.png">
<link rel="stylesheet" href="dist/css/font.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="dist/css/adminlte.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
<body class="hold-transition register-page">
<div class="register-box">
<div class="register-logo">
<div class="col-lg-12 col-md-12 col-sm-12">
  <p style="text-align: center;">
  <img src="dist/img/logo.png" style="height: 200px; width: 200px;">
  </p>
</div>
</div>
<div class="card">
<div class="card-body register-card-body">
<p class="login-box-msg"><b>Registration</b></p>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<label>Full Name:</label>
		<input type="text" id="full_name" class="form-control" autocomplete="off">
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<label>Contact No:</label>
			<input type="tel" id="contact_no" class="form-control" autocomplete="off" value="+63">
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<label>Address:</label>
			<input type="text" id="address" class="form-control" autocomplete="off">
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<label>Username:</label>
		<input type="email" id="username_email" class="form-control" autocomplete="off">
		<p id="result" style="text-align:center;"></p>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<label>Password:</label>
		<input type="password" id="password" class="form-control" autocomplete="off">
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<label>Re-Enter Password:</label>
		<input type="password" id="password2" class="form-control" autocomplete="off">
	</div>
</div>
<div class="social-auth-links text-center mt-2 mb-3">
<a href="#" class="btn btn-block btn-primary" onclick="register_account()"> Register 
<i class="far fa-arrow-alt-circle-right"></i>
</a>

<a href="login.php" class="btn btn-block btn-secondary"> Already have an Account 
<i class="fa fa-question"></i>
</a>
</div>
</div>

</div>
</div>


<script src="node_modules/jquery/dist/jquery.min.js"></script>

<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript">
const validateEmail = (username) => {
  return username.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};

const validate = () => {
  const $result = $('#result');
  const username = $('#username_email').val();
  $result.text('');

  if(validateEmail(username)){
    $result.text('Valid');
    $result.css('color', 'green');
  } else{
    $result.text('Invalid');
    $result.css('color', 'red');
  }
  return false;
}

$('#username_email').on('input', validate);
	
const register_account =()=>{

	let full_name = $('#full_name').val();
	let contact_no = $('#contact_no').val();
	let address = $('#address').val();
	let username = $('#username_email').val();
	let password = $('#password').val();
	let password2 = $('#password2').val();
	let result = $('#result').html();

	if(full_name == ''){
		Swal.fire({
						  title: 'Please Input Full Name',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(contact_no == ''){
		Swal.fire({
						  title: 'Please Input Contact No',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(address == ''){
		Swal.fire({
						  title: 'Please Input Address',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(username == ''){
		Swal.fire({
						  title: 'Please Input Username',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(password == ''){
		Swal.fire({
						  title: 'Please Input Password',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(password2 == ''){
		Swal.fire({
						  title: 'Please Re-Enter Password',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(password != password2){
		Swal.fire({
						  title: 'Password Doesn`t Match',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else if(result == 'Invalid'){
		Swal.fire({
						  title: 'Please Input Proper Email Address',
						  icon: 'info',
						  showConfirmButton: false,
						  timer: 1000
		});
	}else{
		$.ajax({
        url:'process/signup.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'register',
                   	full_name:full_name,
										contact_no:contact_no,
										address:address,
										username:username,
										password:password
                },success:function(response){
                	if (response == 'success') {
                		Swal.fire({
												title: 'Successfully Registered',
												icon: 'info',
												showConfirmButton: false,
												timer: 1000
										});
										$('#full_name').val('');
										$('#contact_no').val('');
										$('#address').val('');
										$('#username_email').val('');
										$('#password').val('');
										$('#password2').val('');
										$('#result').html('');
                	}else if (response == 'existing') {
                		Swal.fire({
												title: 'Already Existing',
												icon: 'info',
												showConfirmButton: false,
												timer: 1000
										});
										$('#full_name').val('');
										$('#contact_no').val('');
										$('#address').val('');
										$('#username_email').val('');
										$('#password').val('');
										$('#password2').val('');
										$('#result').html('');
                	}else{
                		Swal.fire({
												title: 'Error',
												icon: 'error',
												showConfirmButton: false,
												timer: 1000
										});
										$('#full_name').val('');
										$('#contact_no').val('');
										$('#address').val('');
										$('#username_email').val('');
										$('#password').val('');
										$('#password2').val('');
										$('#result').html('');
                	}
                }
    });
	}

}

</script>
</body>
</html>
