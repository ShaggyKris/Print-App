<?php
	session_start();
	include "ChromePhp.php";
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $_SESSION['max_time'])) {
		$_SESSION['expire'] = true;
	}
	
	
	if(isset($_SESSION['expire'])){
		goToLogin();
	}	
		
	function goToLogin(){
		echo "<script type=\"text/javascript\">
					window.location.replace(\"login.php\");
			</script>";//
//		header("location: login.php");
	}
	
	$_SESSION['LAST_ACTIVITY'] = time();
?>