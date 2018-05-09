<?php

	// creating a session id
	session_start();
	$sessionID=session_id();
	setcookie("session_id",$sessionID,time()+3600,"/","localhost",false,true);
	
	
?>
<!DOCTYPE HTML>  
<html>
<head>
 
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
//Function to get the token fom server side
<script> 
function loadDOC(method,url,htmlTag)

    var xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() 
    {
        if(this.readyState==4 && this.status==200)
        {
            console.log("CSRF token scuessfully fetched : "+this.responseText);
            document.getElementById(htmlTag).value = this.responseText;
            
            
            
        }
    };

    xhttp.open(method,url,true);
    xhttp.send();
}
</script>

<?php 
	if (isset($_COOKIE['session_id']))
	{
		echo '<script> loadDOC("POST","validate.php","cs");
		</script>';
		
		
	}

?>

<h2>PHP Form Login Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="validate.php">  
  
  Your Mail: <input type="text" name="email" id="email">
  <span class="error">* </span>
  <br></br>
  Password :  <input type="password" name="password" id="password">
  <span class="error">* </span>
  <br><br>
  <input type="checkbox" name="remember" value=1>
  Remember Me
  <br><br>
  <input type="hidden" id="cs" name="csrf" >

  <input type="submit" name="login" value="login">  
</form>

//this is additional part. When you select remember me check box the next you log/ in your mail will be there in the email field.
<?php
	if(isset($_COOKIE['email'])  )
	{	
		$email= $_COOKIE['email'];
		
		echo "<script>
			document.getElementById('email').value= '$email'
			

		</script>";
	}
	
?>


</body>


</html>
