<?php

	session_start();
	session_destroy();
	echo "Successfully logged out, click here to <a href='login.php'> login again";
?>
