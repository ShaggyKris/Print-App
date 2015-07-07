<?php
	session_start();
	$_SESSION['LAST_ACTIVITY'] = time();
	echo '<script src="https://code.jquery.com/jquery.min.js"></script>';
	
	// Connect to the database
	include "dbLogin.php";
	$id = $_SESSION['login_id'];
	$user = $_SESSION['login_user'];
	
	// Query for a list of all existing files
	$sql = "SELECT `id`,`fileID`, `name`, `mime`, `type`, `size`, `created` FROM `user_files` WHERE `id`='{$id}'";
	$result = $db->query($sql);
	// Check if it was successfull
	if($result) {
			
			// Print the top of a table
			echo '<table width="100%" class="user_file_table">';
			
			// Make sure there are some files in there
			if($result->num_rows == 0) {
				echo "<center>No files to be listed.</center>";
			}
			else{				
				echo '<center><font size="5">Select your files to print</font></center><br>';
				echo '<thead><tr>
						<td>Select</td>
						<td><center><b>Name</b></center></td>
						<td><center><b>File Type</b></center></td>
						<td><center><b>Size (bytes)</b></center></td>
						<td><center><b>Upload Date</b></center></td>
						<td><b>&nbsp;</b></td>
					</tr></thead>';				
			
				// Print each file
				while($row = $result->fetch_assoc()) {
					$fileID = $row['fileID'];
					echo "<tbody><tr>";
					echo "
							<td bgcolor='white'>
								<input type='checkbox' checked>
							</td>
							<td bgcolor='white'>
								{$row['name']}
							</td>
							<td bgcolor='white'>
								{$row['type']}
							</td>
							<td bgcolor='white'>
								{$row['size']}
							</td>
							<td bgcolor='white'>
								{$row['created']}
							</td>
							
							<td>
								<input type='button' name='download' value='Download' onclick='window.location=&quot;get_file.php?fileID=$fileID&quot;;'>
							</td>
							<td>
								<input type='button' name='delete' value='Delete' onclick='window.location=&quot;delete.php?fileID=$fileID&quot;;'>
							</td>
							";
							echo "<td>
								<input type='button' name='print' value='Print' onclick='window.open(\"print.php?fileID=$fileID\",\"print\",\"height=500, width=685, left=100, top=100, resizable=no,scrollbars=no,toolbar=no,status=no\");'>
								
							</td>";

					echo "</tr></tbody>";
				}
				
				echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td>
				<td>
					<input type='button' name='delete all' value='Delete All' onclick='delete_confirm()'>
					<script type='text/javascript'>
						function delete_confirm(){
							var r = confirm('Do you want to remove all files?');
							if (r == true) {
								window.location.replace('delete.php?deleteBool=1');
							}
							else{}
						}
					</script>
				</td></tr>";
				//echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><input type='button' name='delete all' value='Delete All' onclick='window.location=&quot;delete.php?deleteBool=1&quot;;'></td></tr>";
			}
			
			// Close table
			echo '</table>';
			
	}
	else
	{
		echo 'Error! SQL query failed:';
		echo "<pre>{$db->error}</pre>";
	}
?>