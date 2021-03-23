<?php 
	require_once 'core/init.php';

	if (isset($_SESSION['user'])) {
		header("Location:client/");
	}
	
	$wrongPassAlert = '';
	$notExist = '';

	if (isset($_POST['signin'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (isExist($username)) {
			if (!empty(trim($username)) && !empty(trim($password))) {
				if (isValid($username, $password)) {
					$_SESSION['user'] = $username; #save session 
					# Login valid redirect to dashboard
					header("Location:client/");
				}else{
					#login invalid password salah
					$wrongPassAlert = '<p class="alert alert-danger" >Password Incorrect!</p>
			<hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">';
				}
			}
		}else{
			$notExist = '<p class="alert alert-warning" >User Not Registered</p>
			<hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">';
		}
	}

 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>CheatChat - Sign In</title>
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

	<!-- Font Awesome icons (free version)-->
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
		<div class="col-md-4  align-self-center ">
			<h2 class="text-center" ><i class="fa fa-paper-plane" style="filter: drop-shadow(2px 2px 3px grey);"></i></h2>
			<h2 class="mx-auto" style="filter: drop-shadow(2px 2px 3px grey);" >
				Sign In To Start Chatting
			</h2>
			<hr style="border-top: 1px solid white; filter:drop-shadow(1px 1px 1px grey);">
			<!-- alert belongs here -->
			<?php 
			echo $wrongPassAlert;
			echo $notExist;
			 ?>

			<form action="" method="POST">
			  <div class="form-group">
			    <label for="inputUsername">Username</label>
			    <input required="" name="username" type="text" class="form-control" id="inputUsername" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label for="inputPassword">Password</label>
			    <input required="" name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
			  </div>
			  <button type="submit" name="signin" class="btn btn-success" 
			  		  style="background-color: #8f80ad;border: none;">Sign In</button>
			   &emsp; &emsp; <small class="text-light" style="filter: drop-shadow(2px 2px 3px #333);">Need an account? <a href="signup.php" style="color: #8fc2c1">Sign Up</a> now.</small>
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