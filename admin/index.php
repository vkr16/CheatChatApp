<?php 
   require_once '../core/init.php';
   
   $username = $_SESSION['user'];
   
   if (isset($_SESSION['user'])) {
   	if (checkRole($username) == 'user') {
   		header("Location: ../client/");
   	}
   }else{
   	header("Location:../signin.php");
   }

   $today = date('d/m/Y');



   $queryUser = "SELECT * FROM users WHERE role = 'user'";
   $jumlahUser = mysqli_num_rows(mysqli_query($link, $queryUser));
   $queryAdmin = "SELECT * FROM users WHERE role = 'admin'";
   $jumlahAdmin = mysqli_num_rows(mysqli_query($link,$queryAdmin));
   $allUser =  $jumlahAdmin + $jumlahUser;

   $queryRoom = "SELECT DISTINCT secretcode FROM chats";
   $jumlahRoom = mysqli_num_rows(mysqli_query($link,$queryRoom));
   $queryChat = "SELECT * FROM chats";
   $jumlahChat = mysqli_num_rows(mysqli_query($link, $queryChat));



   
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
           $.post("../client/chat-server.php", { code: $("#code").val()}, 
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
                 userRefresh();
                 checkRecent();

		        $("#message").on('keypress',function(e) {
				    if(e.which == 13) {
				        
		                $.post("../client/chat-server.php", {
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
                         $.post("../client/chat-server.php", {
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
         
         
         function userRefresh(){
         	$.post("manage-user.php", {}, 
         	    function(data) {
         	      $("#tableBody").html(data);
         	    }
         	  );
         	 
         	    setTimeout('update()', 100);
         }
         
         function clearRoom(){
         	$.post("../client/clearChat.php", { xcode: $("#code").val()}, 
         	    function(data) {
         	      // 
         	    }
         	  );
         	 
         	    setTimeout('update()', 100);
         }

         function copyCode(theCode){
			document.getElementById('code').value = theCode;
			isEmpty();
		}

         function checkRecent(){
			$.post("../client/recent.php", {}, 
		    function(data) {
		      $("#bodyRecent").html(data);
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
                        <input class="col-md-3 mr-2 form-control" id="code" placeholder="Room code" type="text" name="code" onkeyup="isEmpty()" autocomplete="off"> <!-- room code -->
                        <button class="btn btn-success" disabled="" id="connStatus"></button>
                        <button class="btn btn-light ml-2" id="tombolhapus" data-toggle="modal" data-target="#clearHistory" hidden=""><i class="fas fa-trash"></i> &nbsp;Clear Chat</button>
                     </div>
                  </div>
                  <div class="card-body" id="chatField" style="height: 60vh ;max-height: 60vh; overflow-y: auto;display: flex;flex-direction: column-reverse; background-image: url('../assets/img/chatbg.jpg');background-size: cover; font-family: Montserrat Alternates">
                     <!-- Chats belongs HERE -->
                  </div>
                  <div class="card-footer text-muted">
                     <div class="row">
                        <input class="col-md-10 mr-4 form-control" placeholder="Type your message. . ." id="message" type="text" name="message"> <!-- message -->
                        <input style="background-color: #a996ff" type="submit" name="submitcode" id="send" class="btn btn-info" value="Send">
                     </div>
                  </div>
               </div>
            </div>
            <!-- div kanan -->
            <div class="col-md-6">
               <div class="card border-info mb-3" style="height: 81vh; max-height: 81vh">
                  <nav >
                     <div class="nav nav-tabs text-info" id="nav-tab" role="tablist">
                        <a class="nav-link text-info" id="nav-recent-tab" data-toggle="tab" href="#nav-recent" role="tab" aria-controls="nav-recent" aria-selected="true">Recent</a>
                        <a class="nav-link text-info active" id="nav-admin-tab" data-toggle="tab" href="#nav-admin" role="tab" aria-controls="nav-admin" aria-selected="false">Admin Control Panel</a>
                     </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade  " id="nav-recent" role="tabpanel" aria-labelledby="nav-recent-tab">
                     	<table class="table table-sm table-hover">
						  <tbody id="bodyRecent" >
						  </tbody>
						</table>
                     </div>
                     <div class="tab-pane fade show active" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
                        <div class="" style="height: 74vh ;max-height: 74vh;" >
                           <div class="card-body text-info">
                              <!-- <h5 class="card-title">Administrator Control Panel</h5>
                              <hr> -->
                              <nav>
                                 <div class="nav nav-tabs text-info" id="nav-tab" role="tablist" >
                                    <a class=" text-info nav-link active" id="nav-stat-tab" data-toggle="tab" href="#stats" role="tab" aria-controls="nav-stat" aria-selected="true">Statistics</a>
                                    <a class=" text-info nav-link" id="nav-user-tab" data-toggle="tab" href="#users" role="tab" aria-controls="nav-user" aria-selected="false">Users</a>
                                    <a class=" text-info nav-link" id="nav-chat-tab" data-toggle="tab" href="#chats" role="tab" aria-controls="nav-chat" aria-selected="false">Chats</a>
                                 </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                 <div class="tab-pane fade show active" id="stats" role="tabpanel" aria-labelledby="nav-stat-tab">
                                    <p class="mt-4">Today is <?php echo $today; ?></p>
                                    <table class="text-muted">
                                       <tr>
                                          <td>
                                             <h5>User Statistic</h5>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>User</td>
                                          <td> &emsp;<i class="fa fa-arrow-alt-circle-right"></i>&emsp; </td>
                                          <td> <?php echo $jumlahUser; ?> &nbsp;Accounts</td>
                                       </tr>
                                       <tr>
                                          <td>Administrator</td>
                                          <td> &emsp;<i class="fa fa-arrow-alt-circle-right"></i>&emsp; </td>
                                          <td>  <?php echo $jumlahAdmin; ?> &nbsp;Accounts</td>
                                       </tr>
                                       <tr>
                                          <td>Total Account In Database</td>
                                          <td> &emsp;<i class="fa fa-arrow-alt-circle-right"></i>&emsp; </td>
                                          <td> <?php echo $allUser; ?> &nbsp;Accounts</td>
                                       </tr>
                                    </table>
                                    <hr>
                                    <table>
                                       <tr>
                                          <td>Chat Statistic</td>
                                       </tr>
                                       <tr>
                                          <td>Room Chat Used</td>
                                          <td> &emsp;<i class="fa fa-arrow-alt-circle-right"></i>&emsp; </td>
                                          <td><?php echo $jumlahRoom; ?> Rooms</td>
                                       </tr>
                                       <tr>
                                          <td>Total Chat Sent</td>
                                          <td> &emsp;<i class="fa fa-arrow-alt-circle-right"></i>&emsp; </td>
                                          <td><?php echo $jumlahChat; ?> Chats</td>
                                       </tr>
                                    </table>
                                 </div>
                                 <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="nav-user-tab">
                                    <br>
                                    <h5>Delete User</h5>
                                    <small class="text-danger">Note : Deleting user will delete their chat in all room as well</small>
                                    <hr>
                                    <div class="col-md-12 m-0 p-0" style="" >
                                       <input class="form-control mb-3" placeholder="Search by username" type="text" name="search" id="search" onkeyup="searchFunction()">
                                       <div style="max-height: 35vh; overflow-y: auto;">
	                                       <table class="table table-hover" id="dataTable">
	                                          <thead>
	                                             <tr>
	                                                <th scope="col">id</th>
	                                                <th scope="col">Username</th>
	                                                <th scope="col">Full Name</th>
	                                             </tr>
	                                          </thead>
	                                          <tbody id="tableBody">
	                                             <!-- User Table Belongs HERE -->
	                                          </tbody>
	                                       </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="chats" role="tabpanel" aria-labelledby="nav-chat-tab">
                                    <br>
                                    <h5>Delete Chats</h5>
                                    <small class="text-danger">Admin can delete all messages in all room at once or a specific room only! Be careful, there might be users who are currently using the chat.</small>
                                    <hr>
                                    <form action="deletechat.php" method="POST">
                                       <input type="text" name="clearchatroom" id="clearchatroom" class="form-control" placeholder="Enter the chat room code you want to clean up . . ."><br>
                                       <button class="btn btn-danger" name="clearbutton" id="clearroom">Clear Chat</button>
                                    </form>
                                    <hr>
                                    <button class="btn btn-lg btn-danger" data-toggle="modal" data-target="#deleteAllChats">Clear ALL Chat Room</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end div kanan -->
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
         
         function searchFunction() {
           var input, filter, table, tr, td, i, txtValue;
           input = document.getElementById("search");
           filter = input.value.toUpperCase();
           table = document.getElementById("dataTable");
           tr = table.getElementsByTagName("tr");
           for (i = 0; i < tr.length; i++) {
             td = tr[i].getElementsByTagName("td")[0];
             if (td) {
               txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1) {
                 tr[i].style.display = "";
               } else {
                 tr[i].style.display = "none";
               }
             }       
           }
         }
         
         
      </script>
      <!-- Chat delete Modal -->
      <div class="modal fade" id="deleteAllChats" tabindex="-1" aria-labelledby="decha" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-body">
                  &nbsp;Type <strong>CONFIRM</strong> to continue <br><br>
                  <form action="deletechat.php" method="POST">
                     <input onkeyup ="confDelete()" class="form-control" type="text" name="confirmation" id="confirmation" placeholder="CONFIRM" autocomplete="off"><br>
                     <button class="btn btn-lg btn-danger" id="clearall" name="clearall" disabled="">CLEAR ALL CHAT ROOM</button>
                  </form>
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
         function confDelete(){
         	var confirm = document.getElementById('confirmation').value;
         	var buttonDelete = document.getElementById('clearall').disabled;
         
         	if (document.getElementById('confirmation').value == "CONFIRM") {
         		document.getElementById('clearall').disabled = false;
         	}else{
         		document.getElementById('clearall').disabled = true;
         	}
         }
         
         function conftodelete(){
         	if (document.getElementById('typeConfirm').value == "CONFIRM") {
         		document.getElementById('clearIt').disabled = false;
         	}else{
         		document.getElementById('clearIt').disabled = true;
         	}
         }
      </script>
   </body>
</html>