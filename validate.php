<?php

	//session start
	session_start();
	if(empty($_SESSION['key']))
	{
		$_SESSION['key']=md5(uniqid(mt_rand(),true)); // creating the session key for csrf token
    
	}
	
	//creating csrf token
	$csrf = hash_hmac('sha256',"This is token:login.php",$_SESSION['key']);
	$_SESSION['csrf']= $csrf; // and storin it in session

	ob_start();
	
	// if the user clicked the login button
	if(isset($_POST['login']))
	{
		ob_clean();
		//validation of user email and password and token and user session
		if($_POST['email']=="chamali@gmail.com" && $_POST['password']=="12345" && $_POST['csrf']== $_SESSION['csrf'] && $_COOKIE['session_id']==session_id())
		{
			echo "<script> alert('Login Sucess') </script>";
			
			// this is if the user selected the emember me checkbox
			if(isset($_POST['remember']))
			{
					setcookie('email',$_POST['email'],time()+60*60*7); // set a cookie for email
					setcookie('password',$_POST['password'],time()+60*60*7); // set a cookie for password
			}
			$_SESSION['email']=$_POST['email'];
			echo "Welcome   "   .$_SESSION['email'];
			echo "<a href='logout.php'> Logout</a>";
			
		}
		else
		{
			
			echo "<script> alert('Login Failed') </script>";
			echo "Login Failed and Authorization Failed :(";
		}
		
		
		
	}
	
		
	
	
?>
