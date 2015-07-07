<html>
	<body onload="javscript:window.print()"> 
		<?php
			//
			include "session_time.php";
			include "ChromePhp.php";
			// Make sure an ID was passed
			if(isset($_GET['fileID'])) {
			// Get the ID
				$fileID = intval($_GET['fileID']);
 
				// Make sure the ID is in fact a valid ID
				if($fileID <= 0) {
					die('The ID is invalid!');
				}
				else {
					// Connect to the database
					include "dbLogin.php";
 
					// Fetch the file information
					$query = "
						SELECT `mime`, `name`, `size` 
						FROM `user_files`
						WHERE `fileID` = {$fileID}";
					$result = $db->query($query);
 
					if($result) {
						// Make sure the result is valid
						if($result->num_rows == 1) {
						// Get the row
							$row = mysqli_fetch_assoc($result);
							
							$type = dirname($row['mime']);
														
							
							//Print headers
//							header("Content-Type: ". $row['mime']);
//							header("Content-Disposition: inline; filename=". $row['name']);
									
							$targetFile = "uploads".DIRECTORY_SEPARATOR.$row['name'];
							ChromePhp::log($targetFile);
							echo '<img src="'.$targetFile.'">';
							
							
						}
						else {
							echo 'Error! No image exists with that ID.';
					
						}
 
						// Free the mysqli resources
						@mysqli_free_result($result);
					}
					else {
						echo "Error! Query failed: <pre>{$db->error}</pre>";
						echo "<script>setTimeout(\"location.href = 'javascript::history.back()';\",10);</script>";
					}
					@mysqli_close($db);
				}
			}
			else {
				echo 'Error! No ID was passed.';
				echo "<script>setTimeout(\"location.href = 'javascript::history.back()';\",10);</script>";
			}	
		?>
		
	</body>
</html>