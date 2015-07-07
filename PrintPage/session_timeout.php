<?php
	session_start();
	
	include "dbLogin.php";
	$id = $_SESSION['login_id'];
	$user = $_SESSION['login_user'];
	
	$query = "SELECT `id` FROM `user` WHERE `id` = {$id}";
	
	$result = $db->query($query);
	
	if($result->num_rows <= 0) {
		$_SESSION['expire'] = true;
		header("location: login.php");
	}
?>