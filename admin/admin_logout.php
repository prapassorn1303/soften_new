<?php
	session_start();

	$params = session_get_cookie_params();
	setcookie(session_name(),'',time() - 42000,
			$params["path"],$params["domain"],
			$params["secure"],$params["httponly"]);
	if (session_destroy()) {
		setcookie('logout_success',1,time()+5,'/');
		echo "<script type='text/javascript'> window.location.href = '../index.php';</script>";
	}else {
		setcookie('logout_error',1,time()+5,'/');
		echo "<script type='text/javascript'> window.location.href = '../admin_home.php';</script>";
	}
	
?>