<?php 
	require_once 'core/init.php';

	if (isset($_SESSION['user'])) {
		header("Location:client/");
	}
	
	$successAlert = '';
	$failAlert	  = '';
	$alreadyExist = '';

	if (isset($_POST['signup'])) {
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email 	  = $_POST['email'];
		$password = $_POST['password'];

		if (!empty(trim($fullname)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password))) {
			if (isRegistered($username, $email)) {
				// echo "belom ada";
				if (registerUser($fullname,$username,$email,$password)) {
					// echo "berhasil masuk db";
					$successAlert = '<div class="alert alert-success text-center"><h6>Registration successful! <a style="color:#a46de8;" class="link" href="signin.php">Click here to sign in</a></h6></div><hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">';
				}else{
					// echo "Gagal regis";
					$failAlert = '<div class="alert alert-danger text-center"><h6>Registration Failed! There is something wrong in our side, please try again later!</h6></div><hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">';
				}
			}else{
				// echo "udah ada bang";
				$alreadyExist = '<div class="alert alert-warning text-center"><h6>Oops! an account with that username or email already exist in our database</h6></div><hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">';
			}
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>CheatChat - Sign Up</title>
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

	<!-- Font Awesome icons -->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
	<!-- Bootstrap Files -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@700&display=swap" rel="stylesheet">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<style type="text/css">
		font-family: 'Berkshire Swash', cursive;
		font-family: 'Courier Prime', monospace;
	</style>
</head>
<body  style="background-image: url('assets/img/crack.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">

	<!-- Navigation Bar as Title Bar -->
	<nav class="navbar navbar-light bg-light mb-4 ">
		<div class="container">
		  <a href="index.php" class="navbar-brand"  style="font-family: Berkshire Swash; "><i class="fas fa-heart-broken"></i> CheatChat <i class="fas fa-heart"></i></a>
		  <form class="form-inline">
		   	<a style="font-family: Courier Prime"><i class="fas fa-code"></i> with <i class="fas fa-heart"></i> by Fikri M</a>
		  </form>
		</div>
	</nav>


	<!-- Main Content -->
	<div class="container text-white d-flex" style="font-family: Berkshire Swash;">
		<div class="col-md-5  align-self-center ">
			<h2 class="text-center" ><i class="fa fa-paper-plane" style="filter: drop-shadow(2px 2px 3px grey);"></i></h2>
			<h2 class="mx-auto text-center" style="filter: drop-shadow(2px 2px 3px grey);" >
				Sign Up To CheatChat
			</h2>
			<hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">
			<!-- alert belongs here -->
			<div id="alrtss">
			<?php 
				echo $successAlert;
				echo $failAlert;
				echo $alreadyExist;
			 ?>
			</div>
			<form action="" method="POST">
			  <div class="form-group">
			    <label for="regName">Full Name</label>
			    <input required="" name="fullname" type="text" class="form-control" id="regName" placeholder="Full Name">
			  </div>
			  <div class="row">
				  <div class="form-group col-md-4 pr-1">
				    <label for="regUsername">Username</label>
				    <input required="" name="username" type="text" class="form-control" id="regUsername" placeholder="Username">
				  </div>
				  <div class="form-group col-md-8 pl-1">
				    <label for="regEmail">Email Address</label>
				    <input required="" name="email" type="email" class="form-control" id="regEmail" placeholder="Email Address">
				  </div>
			  </div>
			  <div class="row">
				  <div class="form-group col-md-6 pr-1">
				    <label for="regPassword">Password</label>
				    <input required="" name="password" onkeyup="isMatch()" onchange="isMatch()" type="password" class="form-control" id="regPassword" placeholder="Password">
				  </div>
				  <div class="form-group col-md-6 pl-1">
				    <label for="regPassword">Confirm Password</label>
				    <input required="" name="confirmPassword" onkeyup="isMatch()" onchange="isMatch()"  type="password" class="form-control" id="repPassword" placeholder="Confirm Password">
				  </div>
			  </div>
			  <button type="submit" id="signupButton" name="signup" class="btn btn-success" 
			  		  style="background-color: #8fc2c1;border: none;" disabled="">Sign Up</button>
			   &emsp; &emsp; <small class="text-light" style="filter: drop-shadow(2px 2px 3px #333);">Already have an account? <a href="signin.php" style="color:#c8b4f0">Sign In</a> instead.</small>
			</form>
			<br>
		</div>
	</div>


	<!-- Footer as Copyright Declaration -->
    <footer class="footer bg-black small text-center text-white-50 mb-4 fixed-bottom sticky-bottom">
    	<div class="container">
    		Copyright © CheatChat 2021
    	</div>
    </footer>




</body>
</html>




<script type="text/javascript">
	function isMatch(){
		if (document.getElementById('repPassword').value == document.getElementById('regPassword').value) {
			document.getElementById('signupButton').disabled = false;
			document.getElementById('alrtss').innerHTML = '';

		}else{
			document.getElementById('signupButton').disabled = true;
			document.getElementById('alrtss').innerHTML = '<div class="alert alert-warning text-center">Password Mismatch</div><hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">';
		}
		

	}
</script>