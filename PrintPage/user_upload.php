<?php
	session_start();
	
	$quotaNum =  3; // set quota via LDAP reference
?>


<html>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery.min.js"></script> <!-- Adds JQuery support -->
	<script src="dropzone.js" type="text/javascript"></script>
	
	<div id="sessionTime">
		<?php
			include "session_time.php";
		?>
	</div>
	<script type="text/javascript">
		var sesh = $('#sessionTime');

		var refresh = setInterval(function(){
			sesh.load("session_time.php");
		}, 120000);
	</script>
	<head>
		
		<title>Print App</title>
		<br>
		<font size="20">
			<center>Welcome <?php echo $_SESSION['login_user'];?></center>
			<input type="button" name="logout" value="Logout" onclick="window.location = 'logout.php';">
		</font>
			
		
		<br>
		<br>
	</head>
	
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	<form id="upload" name="upload" action="upload.php" class="dropzone" method="post" enctype="multipart/form-data">
		<div class="fallback"></div>
	</form>
	
	
	<!-- 
<center><form id="uploaded_file" name="uploaded_file" action="upload.php" method="post" enctype="multipart/form-data">
		<label for="uploaded_file">If the above does not display, choose files here</label>
		<br>
		<input type="file" id="uploaded_file" name="uploaded_file" multiple="multiple"/>
		<button type="submit">Upload Files</button>
	</form></center>
 -->




	<!-- <input type="button" name="fileList" value="See All Files" onclick="window.location='list_user_files.php';"> -->
	<br>
	<br>
	<body>
		
		<div id="user_files">
			<?php 
				include_once "list_user_files.php"; // Lists files
			?>
		</div>
		<!-- Refreshes the user files based on database contents -->
		<script type="text/javascript">
			var user_files = $('#user_files');
		
			Dropzone.options.upload = { // Loads files to page on Dropzone complete event
				init: function() {
					this.on('complete', function() {
						user_files.load("list_user_files.php");
					});
				}
			};
		</script>
		
		<br>
		<br>
		<center>
			<div id="selectOptions">
				<font size="4">Printers</font>
				<br>
				<br>
				<select>
					<option selected="selected">Select Your Printer</option>
					<option>------------------</option>
					<option>ugrad-2-lw</option>
					<option>grad-1-lw</option>
					<option>teachinglab-2-lw</option>
				</select>
			</div>
			<br>
			<input type='button' name='print' value='Print' onclick='window.location=&quot;javascript:window.print()&quot;;'>
		</center>
		
			
	
	
	
	<br>
	<br>
	
	<!-- HERE DA PAYPAL SHIZNITS -->
	<center><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="7ZT5QYLWDSLFL">
		
		<h3>Quota: $<span><?php echo $quotaNum;?></h3>		
		<h3>WANT MORE PRINT CREDITS?</h3>
		<table>
			<tr>
				<td>
					<input type="hidden" name="on0" value="Amount">
				</td>
			</tr>
			<tr>
				<td>
					<center><select name="os0">
						<option value="$2">$2 </option>
						<option value="$5">$5 </option>
						<option value="$10">$10 </option>
					</select></center>
				</td>
			</tr>
		</table>
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form></center>
	<!-- END OF PAYPAL SHIZNITS -->

	<br>
	<br>
				
	
	<!-- 
<div id="noUser">
		<?php include "session_timeout.php";?>
	</div>
	<!~~ Quits session if user no longer exists in the database ~~>
	<script type="text/javascript">
		var noUser = $('#noUser');

		var refOptions = setInterval(function(){
			noUser.load("session_timeout.php");
		}, 5000);
	</script>
 -->
	</body>
</html>

