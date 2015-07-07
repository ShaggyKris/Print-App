<?php
	session_start(); //new
	
	include 'ChromePhp.php';
	$_SESSION['LAST_ACTIVITY'] = time();
	$ds           = DIRECTORY_SEPARATOR;
	$storeFolder  = 'uploads';
	include "dbLogin.php";
	
	$targetPath = dirname(__FILE__).$ds.$storeFolder.$ds;
	
	if (!empty($_FILES)) {		
		$id = $_SESSION['login_id']; //new
		
		$name = basename( $_FILES['file']['name']);
		
		$type = pathinfo($name,PATHINFO_EXTENSION);	//gathers extension
		
		//Removes periods and whitespace in filename, replacing periods with underscores
		$name = str_replace(' ','', $name); //removes spaces
		$name = preg_replace('/\s+/','',$name); //removes whitespace
		$name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $name); //removes extension
		$name = str_replace('.','_',$name); //replaces periods with underscores
		$name = $name.".".$type; //re-adds extension
		
		$mime = $_FILES['file']['type'];
		
		$size = $_FILES['file']['size'];
		
		$data = $_FILES['file']['tmp_name'];
		
		
		
		$max_size = 10000000;
		
		
		
		if($size<$max_size){
			$targetFile = $targetPath.$name;
		
			move_uploaded_file($data,$targetFile);
			chmod($targetFile,0777);
			
			$query = "
						INSERT INTO user_files (
							`id`,`name`,`mime`,`type`,`size`,`created`
						)
						VALUES (
							'{$id}','{$name}', '{$mime}', '{$type}', '{$size}', NOW()
						
					)";
			$result = $db->query($query);				
		//if ($size<$max_size) {
//			$query = "
//					INSERT INTO `user_files` (
//						`id`,`name`, `mime`, `type`, `size`, `data`, `created`
//					)
//					VALUES (
//						'{$id}','{$name}', '{$mime}', '{$type}', '{$size}', '{$data}', NOW()
//					)"; //'{$id}' is new
//
//			$result = $db->query($query);
		}
		else {
			echo "File exceeds size limit!";
		}
	}
	
?>