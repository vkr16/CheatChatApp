<?php 
	require_once 'core/init.php';

	if (isset($_SESSION['user'])) {
		header("Location:client/");
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>CheatChat App</title>
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
<body style="background-image: url('assets/img/crack.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">

	<!-- Navigation Bar as Title Bar -->
	<nav class="navbar navbar-light bg-light ">
		<div class="container">
		  <a href="index.php" class="navbar-brand"  style="font-family: Berkshire Swash; "><i class="fas fa-heart-broken"></i> CheatChat <i class="fas fa-heart"></i></a>
		  <form class="form-inline">
		   	<a style="font-family: Courier Prime"><i class="fas fa-code"></i> with <i class="fas fa-heart"></i> by Fikri M</a>
		  </form>
		</div>
	</nav>


	<!-- Main Content -->
	<div class="container text-white d-flex" style="font-family: Berkshire Swash; height: 50vh">
		<div class="col-md-7 align-self-center ">
			<h2 class="" style="filter: drop-shadow(2px 2px 3px grey);" >
				CheatChat Is A Free & Secure App to Chat With Your Cheating Partner 
			</h2><br>
			<a href="signin.php" 	class="btn btn-lg btn-success" style="background-color: #8f80ad;border: none;">Sign In</a>
			&nbsp; Or &nbsp; 
			<a href="signup.php" 	class="btn btn-lg btn-info" style="background-color: #8fc2c1;border: none">Sign Up</a>
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