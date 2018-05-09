<?php

	
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
<script> 
function loadDOC(method,url,htmlTag)
{
    var xhttp = new XMLHttpRequest(); //create variable for store HTTP requests
    xhttp.onreadystatechange = function() //excute when recive an answer from server side
    {
        if(this.readyState==4 && this.status==200)
        {
            console.log("CSRF token scuessfully fetched : "+this.responseText);
            document.getElementById(htmlTag).value = this.responseText;
            //return this.responseText; //return response
            
            
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