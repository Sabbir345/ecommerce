<?php
	$login = Session::get("userlogin");
	if($login == true){
		header("Location:login.php");
	}
?>