<?php  

	require_once '../core/init.php';
	$username = $_SESSION['user'];

	$query = "SELECT DISTINCT secretcode FROM chats WHERE username = '$username'";

 	$exec = mysqli_query($link, $query);

 	

 	while ($row = mysqli_fetch_assoc($exec) ){

 	echo   '<tr>
		      <td  style="max-width: 100px ;overflow: hidden;white-space: nowrap; text-overflow: ellipsis;">'.$row['secretcode'].'</td>
		      <th scope="row"><a class="text-info" href="#" onclick="copyCode(\''.$row['secretcode'].'\')" style="text-decoration : none;">Connect!</a></th>
		      
		    </tr>';
		    
	}