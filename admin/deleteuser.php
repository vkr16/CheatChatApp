<?php 
require_once '../core/db.php';
if (isset($_GET['delete'])) {
	$usertodelete = $_GET['delete'];
	$query = "DELETE FROM users WHERE username = '$usertodelete'";
	if (mysqli_query($link, $query)) {
		$queryChats = "DELETE FROM chats WHERE username = '$usertodelete'";
		if (mysqli_query($link, $queryChats)) {
			header("Location:index.php");
		}
	}
}