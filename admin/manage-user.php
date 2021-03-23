<?php 
 	require_once '../core/db.php';

 	$query = "SELECT * FROM users WHERE username != 'admin'";

 	$exec = mysqli_query($link, $query);

 	

 	while ($row = mysqli_fetch_assoc($exec)){
 	echo   '<tr>
		      <th scope="row">'.$row['id'].'</th>
		      <td><a class="nav-item text-info" href="deleteuser.php?delete='.$row['username'].'">'.$row['username'].'</a></td>
		      <td>'.$row['fullname'].'</td>
		    </tr>';
	}
 ?>