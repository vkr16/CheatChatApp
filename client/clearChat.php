<?php 
require_once '../core/db.php';

if (isset($_POST['xcode'])) {
	$code = $_POST['xcode'];

	$query = "DELETE FROM chats WHERE secretcode = '$code'";
	if (mysqli_query($link,$query)) {
		return true;
	}
}