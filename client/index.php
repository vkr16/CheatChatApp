<?php 
	require_once '../core/init.php';
	$username = $_SESSION['user'];

	if (isset($_SESSION['user'])) {
		if (checkRole($username) == 'admin') {
			header("Location: ../admin/");
		}
	}else{
		header("Location:../signin.php");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>CheatChat - Home</title>
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

	<!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
	<!-- Bootstrap Files -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300&display=swap" rel="stylesheet">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="../assets/img/icon.png">
	<style type="text/css">
		font-family: 'Berkshire Swash', cursive;
		font-family: 'Courier Prime', monospace;
		font-family: 'Montserrat Alternates', sans-serif;
	</style>
</head>
<body>
	<script type="text/javascript">
		function update()
		{
		  $.post("chat-server.php", { code: $("#code").val()}, 
		    function(data) {
		      $("#chatField").html(data);
		    }
		  );
		 
		    setTimeout('update()', 1000);
		}
		 
		$(document).ready(
		    function() {
		        update();
		        isEmpty();
		        checkRecent();

		        $("#message").on('keypress',function(e) {
				    if(e.which == 13) {
				        
		                $.post("chat-server.php", {
		                        message: $("#message").val(),
		                        code: $("#code").val()
		                    },
		                    function(data) {
		                        $("#chatField").html(data);
		                        $("#message").val("");
		                    }
		                );
				    }
				});

		        $("#send").click(
		            function() {
		                $.post("chat-server.php", {
		                        message: $("#message").val(),
		                        code: $("#code").val()
		                    },
		                    function(data) {
		                        $("#chatField").html(data);
		                        $("#message").val("");
		                    }
		                );
		            }
		        );
		    }
		);


		function checkRecent(){
			$.post("recent.php", {}, 
		    function(data) {
		      $("#bodyRecent").html(data);
		    }
		  );
		 
		    setTimeout('update()', 100);
		}

		function copyCode(theCode){
			document.getElementById('code').value = theCode;
			isEmpty();
		}

		function clearRoom(){
			$.post("../client/clearChat.php", { xcode: $("#code").val()}, 
			    function(data) {
			      // 
			    }
			  );
			 
			    setTimeout('update()', 100);
		}

	</script>



	<!-- Navigation Bar as Title Bar -->
	<nav class="navbar navbar-light bg-light mb-4">
		<div class="container">
		  <a href="index.php" class="navbar-brand"  style="font-family: Berkshire Swash; "><i class="fas fa-heart-broken"></i> CheatChat <i class="fas fa-heart"></i></a>
		  <form class="form-inline">
		   	<a style="font-family: Courier Prime; "><i class="fas fa-code-branch"></i> Hello <?php echo $_SESSION['user']; ?> &emsp;|| &emsp; <a href="../logout.php" class="btn btn-secondary" style="color: white"><i class="fas fa-power-off"></i>&nbsp; Sign Out </a></a>
		  </form>
		</div>
	</nav>

	<!-- Main container -->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
				  <div class="card-header">
				  	<div class="row">
					    <input class="col-md-3 mr-2 form-control" id="code" placeholder="Room code" type="text" name="code" onkeyup="isEmpty()" onchange="isEmpty()" autocomplete="off"> <!-- room code -->
					    <button class="btn btn-success" disabled="" id="connStatus"></button>
					    <button class="btn btn-light ml-2" id="tombolhapus" data-toggle="modal" data-target="#clearHistory" hidden=""><i class="fas fa-trash"></i> &nbsp;Clear Chat</button>
				  	</div>
				  </div>
				  <div class="card-body" id="chatField" style="height: 60vh ;max-height: 60vh; overflow-y: auto;display: flex;flex-direction: column-reverse; background-image: url('../assets/img/chatbg.jpg');background-size: cover; font-family: Montserrat Alternates">
				  </div>
				  <div class="card-footer text-muted">
				    <div class="row">
					    <input class="col-md-10 mr-4 form-control" placeholder="Type your message. . ." id="message" type="text" name="message"> <!-- message -->
					    <input type="submit" style="background-color: #a996ff" name="submitcode" id="send" class="btn btn-info" value="Send">
				  	</div>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert alert-success" role="alert" style="height: 70vh ;max-height: 81vh;overflow-y: auto;">
				  <h4 class="alert-heading">Recent Rooms</h4><hr>
				  <table class="table table-sm table-hover">
					  
					  <tbody id="bodyRecent" >
					    
					  </tbody>
					</table>
				 
				</div>
				<div class="container text-center text-muted" >
		    		<p class="mt-4">Copyright © CheatChat 2021</p>
			    </div>
			</div>
		</div>
	</div>



	<!-- Modal untuk clear room chat -->
	<div class="modal fade" id="clearHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
	    <div class="modal-content">
	      <div class="modal-body">
	      	&nbsp;Type <strong>CONFIRM</strong> to continue <br><br>
		        <input onkeyup ="conftodelete()" class="form-control" type="text" name="confirmation" id="typeConfirm" placeholder="CONFIRM" autocomplete="off"><br>
		        <button onclick="clearRoom()" class="btn btn-danger" id="clearIt" name="clearall" disabled=""><i class="fas fa-trash"></i> &nbsp;Clear</button><br>
		        <small class="text-danger">Note : It will do nothing if the chat already empty</small>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
			
	function isEmpty(){
		var codeField = document.getElementById('code').value;

		if (codeField == "") {
			document.getElementById('connStatus').innerHTML = 'Disconnected';	
			document.getElementById('connStatus').className = 'btn btn-danger';	
			document.getElementById('message').disabled = true;
			document.getElementById('send').disabled = true;
			document.getElementById('chatField').innerHTML = 'Insert room code to start chatting';
			document.getElementById('tombolhapus').hidden = true;


		}else{
			document.getElementById('connStatus').innerHTML = 'Connected';	
			document.getElementById('connStatus').className = 'btn btn-success';	
			document.getElementById('message').disabled = false;
			document.getElementById('send').disabled = false;
			document.getElementById('tombolhapus').hidden = false;


		}
	}

	function conftodelete(){
		if (document.getElementById('typeConfirm').value == "CONFIRM") {
			document.getElementById('clearIt').disabled = false;
		}else{
			document.getElementById('clearIt').disabled = true;
		}
	}

	// $("#message").on('keypress',function(e) {
	//     if(e.which == 13) {
	//         alert('You pressed enter!');
	//     }
	// });
	</script>




</body>
</html>