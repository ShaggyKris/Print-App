<?php
	session_start();
	include "session_time.php";
	// Connect to the database
	include "dbLogin.php";
	// Make sure an ID was passed
	$dir = "uploads".DIRECTORY_SEPARATOR;
	if(isset($_GET['fileID'])) {
	// Get the ID
		$fileID = intval($_GET['fileID']);
 
		// Make sure the ID is in fact a valid ID
		if($fileID <= 0) {
			die('No such file!');
			
		}
		else {
			
 			$files = "SELECT * FROM `user_files` WHERE `fileID` = {$fileID}";
			$result = $db->query($files);
			while($row = $result->fetch_assoc()) {
				array_map('unlink', glob($dir.$row['name']));
			}
			// Fetch the file information
			$query = "DELETE FROM `user_files` WHERE `fileID` = {$fileID}";
			$result = $db->query($query);
 
			if($result) {
				 
				// Free the mysqli resources
				@mysqli_free_result($result);
			}
			else {
				echo "Error! Query failed: <pre>{$db->error}</pre>";
			}
			@mysqli_close($db);
		}
	}
	else if (isset($_GET['deleteBool'])) {
		$deleteBool = intval($_GET['deleteBool']);
		
		if ($deleteBool == 1){
			
			$userID = $_SESSION['login_id'];
// 			Fetch the file information
			$files = "SELECT * FROM `user_files` WHERE `id` = {$userID}";
			$result = $db->query($files);
			while($row = $result->fetch_assoc()) {
				array_map('unlink', glob($dir.$row['name']));
			}
			$query = "DELETE FROM `user_files` WHERE `id` = {$userID}";
			$result = $db->query($query);
			if($result) {
				 
				// Free the mysqli resources
				@mysqli_free_result($result);
			}
			else {
				echo "Error! Query failed: <pre>{$db->error}</pre>";
			}
			@mysqli_close($db);
		}
	}
	else {
		echo 'Error! No ID was passed.';
	}
	header('Location: user_upload.php');
?>