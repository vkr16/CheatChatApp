<?php 
	
function isRegistered($username, $email){

	global $link;

	$username = mysqli_real_escape_string($link, $username);
	$email	  = mysqli_real_escape_string($link, $email);

	$query	  = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";

	if ($result = mysqli_query($link,$query) ) {
		if (mysqli_num_rows($result) == 0) {
			//user belum didaftarkan dan bisa di lanjutkan proses registrasi
			return true;
		}else {
			//user sudah pernah didaftarkan dan ada di database
			return false;
		}
	}
}

function registerUser($fullname,$username,$email,$password){
	global $link;

	$fullname = mysqli_real_escape_string($link, $fullname);
	$username = mysqli_real_escape_string($link, $username);
	$email = mysqli_real_escape_string($link, $email);
	$password = mysqli_real_escape_string($link, $password);
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$query  = "INSERT INTO users (username, fullname, email, password) VALUES ('$username' , '$fullname' , '$email' , '$password')";

	if (mysqli_query($link,$query)) {
		//Berhasil input user ke db
		return true;
	}else{
		//Gagal input user ke db
		return false;
	}
}

function isExist($username){

	global $link;

	$username = mysqli_real_escape_string($link, $username);

	$query = "SELECT * FROM users WHERE username = '$username'";

	if ($result = mysqli_query($link,$query) ) {
		if (mysqli_num_rows($result) > 0) {
			//user ada di database
			return true;
		}else {
			//user tidak ada di database
			return false;
		}
	}
}

function isValid($username, $password){

	global $link;

	$username = mysqli_real_escape_string($link, $username);
	$password = mysqli_real_escape_string($link, $password);

	$query = "SELECT * FROM users WHERE username =  '$username'";

	$result = mysqli_query($link, $query);
	$hash = mysqli_fetch_assoc($result);

	if (password_verify($password, $hash['password'])) {
		//kalau password cocok dengan hash yg di database
		return true;
	}else{
		//kalau password tidak cocok dengan hashed password yg di database
		return false;
	}
}


function checkRole($username){
	global $link;

	$username = mysqli_real_escape_string($link, $username);
	

	$query ="SELECT * FROM users WHERE username = '$username'";

	$exec = mysqli_query($link, $query);

	$result = mysqli_fetch_array($exec);

	return $result['5'];
}


 ?>