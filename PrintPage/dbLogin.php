<?php
	$db = mysqli_connect("db.cs.dal.ca","pervin","metroid","pervin");
	if(mysqli_connect_errno()) {
		die("MySQL connection failed: ". mysqli_connect_error());
	}
?>