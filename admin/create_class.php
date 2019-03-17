<?php 
	session_start();
	include '../connect.php';

	$stmt=$pdo->prepare("INSERT INTO classroom (c_id , c_name , c_year , c_term , c_password) VALUES (?,?,?,?,?)");
	$stmt->bindParam(1,$_POST['c_id']);
	$stmt->bindParam(2,$_POST['c_name']);
	$stmt->bindParam(3,$_POST['c_year']);
	$stmt->bindParam(4,$_POST['c_term']);
	$stmt->bindParam(5,$_POST['c_password']);

	if ($stmt->execute()) {
		setcookie('create_success',1,time()+5,'/');
		echo "<script type='text/javascript'> window.location.href = 'admin_home.php';</script>";
	}else{
		setcookie("create_error",1,time()+5,'/');
		echo "<script type='text/javascript'> window.location.href = 'admin_home.php';</script>";
	}
?>