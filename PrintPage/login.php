<?php
	session_start();
	$user = $pswd = $error = "";
	if (isset($_SESSION['expire'])){
		
		session_unset();		
		session_destroy();
		$error = "Session expired.";		
	}
	if (isset($_SESSION['logout'])){
		session_unset();
		session_destroy();
		$error = "You have been logged out.";
	}
	
	$_SESSION['LAST_ACTIVITY'] = time(); //Used to measure last request from the user in order to restart timeout clock
	$_SESSION['max_time'] = 600; //Sets when the session will timeout/expire in seconds
	
	//Gets request from login page
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$db = mysqli_connect("db.cs.dal.ca","pervin","metroid","pervin");

		if(mysqli_connect_errno()) {
			die("MySQL connection failed: ". mysqli_connect_error());
		}
		
		$user = test_input($_POST['login']);
		$pswd = test_input($_POST['password']); /*Use sha1() for the password in future for secure authentication */

		$query = "SELECT `id` FROM `user` WHERE BINARY `name` = '{$user}' AND `pswd` = '{$pswd}'";


		$result = $db->query($query);
		
		$rows = mysqli_num_rows($result); //Get how many rows are returned
		
		$user_id = $result->fetch_assoc(); //Get id from logged user
		$id = $user_id['id'];
		if($rows == 1) { //check to see if there is only one user returned
			$_SESSION['login_id'] = $id;
			$_SESSION['login_user'] = $user;
			$result->free();			
			header("Location: user_upload.php");
		}
		else {
			$error = "Username or Password is invalid";
		}
		$db->close();		
	}
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}		
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Print System Client</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <center><div class="login">
      <h1>Welcome to the Print Site</h1>
      <h1>Login</h1>
      <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
      	<font color="red"><?php echo $error;?></font>
        <p><input type="text" name="login" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <!-- 
<label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
 -->
        </p>
        
        <input type="submit" name="commit" value="Login">
        <input type="button" name="register" value="Register" onclick="window.location='register.php';">        
      </form>
    </div></center>

    <!-- 
<div class="login-help">
      <p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>
    </div>
 -->
  </section>
	
  
</body>

</html>

<?php
	if(isset($_SESSION['login_id'])){
		header("location: user_upload.php");
	}
?>