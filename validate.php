<?php

	
	session_start();
	if(empty($_SESSION['key']))
	{
		$_SESSION['key']=bin2hex(random_bytes(32));
    
	}

	$csrf = hash_hmac('sha256',"This is token:login.php",$_SESSION['key']);
	$_SESSION['csrf']= $csrf;

	ob_start();
	
	if(isset($_POST['login']))
	{
		ob_end_clean();
		if($_$_POST['email']=="chamali@gmail.com" && $_$_POST['password']=="12345" && $_POST['csrf']== $_SESSION['csrf'] && $_COOKIE['session_id']==session_id())
		{
			echo "<script> alert('Login Sucess') </script>";
			
			if(isset($_POST['remember']))
			{
					setcookie('email',$_email,time()+60*60*7);
					setcookie('password',$_password,time()+60*60*7);
			}
			$_SESSION['email']=$_$_POST['email'];
			header("location:welcome.php");	
			apc_delete('csrf');
		}
		else
		{
			
			echo "<script> alert('Login Failed') </script>";
			echo "Login Failed and Authorization Failed :(";
		}
		
		
		
	}
	
		
	
	
?>