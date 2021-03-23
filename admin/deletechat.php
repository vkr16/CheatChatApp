<?php 
require_once '../core/db.php';
	if (isset($_POST['clearchatroom'])) {
		$rc = $_POST['clearchatroom'];

		$query = "DELETE FROM chats WHERE secretcode = '$rc'";
		$execute = mysqli_query($link, $query);
		header("Location: index.php");
	}

	if (isset($_POST['clearall'])) {
		$sqlDeleteAll = "DELETE FROM chats WHERE id >= 0";
		mysqli_query($link, $sqlDeleteAll);
		header("Location: index.php");
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>


 

 <script type="text/javascript">
 	// Total seconds to wait
    var seconds = 4;
    
    function countdown() {
        seconds = seconds - 1;
        if (seconds < 0) {
            // Chnage your redirection link here
            window.location = "index.php";
        } else {
            // Update remaining seconds
            document.getElementById("countdown").innerHTML = seconds;
            // Count down using javascript
            window.setTimeout("countdown()", 1000);
        }
    }
    
    // Run countdown function
    countdown();
 </script>
 </body>
 </html>