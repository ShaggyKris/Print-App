<?php
	session_start();
	$_SESSION['logout'] = true;
	header("location: print_app.html");
?>