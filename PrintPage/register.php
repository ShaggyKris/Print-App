<?php	
	$user = $pswd = $error = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$db = mysqli_connect("db.cs.dal.ca","pervin","metroid","pervin");
		if(mysqli_connect_errno()) {
			die("MySQL connection failed: ". mysqli_connect_error());
		}
		$user = $_POST['login'];
		$pswd = $_POST['password']; /*Use sha1() for the password in future for secure authentication */

		$query = "
				INSERT INTO `user` (
				`name`, `pswd`
				)
				VALUES (
					'{$user}', '{$pswd}'
				)";


		$result = $db->query($query);
		
		
		if($result){
					
			header("Location: login.php");
		}
		else {
			$error = "Error". mysqli_error($result);
		}
	}
?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1><i>Register Yourself</i></h1>
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
        <input type="submit" name="commit" value="Submit">
        <input type="button" name="back" value="Back" onclick="window.location='javascript:history.back();';">
      </form>
    </div>

    <!-- 
<div class="login-help">
      <p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>
    </div>
 -->
  </section>
	
  
</body>

</html>