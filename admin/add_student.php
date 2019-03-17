<?php 
	session_start();
	include '../connect.php';

	$stmt=$pdo->prepare("SELECT c_id , c_name , c_password FROM classroom WHERE c_id = ?");
	$stmt->bindParam(1,$_POST['c_id']);
	$stmt->execute();
	while ($row=$stmt->fetch()) {
		$rowCId['c_id'] = $row['c_id'];
		$rowCName['c_name'] = $row['c_name'];
		$rowPass['c_password'] = $row['c_password'];
	}

	$pass = $_POST['c_password'];
	$user = $_SESSION['username'];

	$stmt2=$pdo->prepare("SELECT * FROM teacher WHERE l_username = ?");
	$stmt2->bindParam(1,$_SESSION['username']);
	$stmt2->execute();
	while ($row2=$stmt2->fetch()) {
		$rowLName['l_name'] = $row2['l_name'];
	}

	if ($rowPass['c_password'] == $pass) {
		 $stmt3=$pdo->prepare("INSERT INTO enroll (c_id,c_name,l_name,s_id,s_name,s_sec) VALUES (?,?,?,?,?,?)");
		 $stmt3->bindParam(1,$_POST['c_id']);
		 $stmt3->bindParam(2,$rowCName['c_name']);
		 $stmt3->bindParam(3,$rowLName['l_name']);
		 $stmt3->bindParam(4,$_POST['s_id']);
		 $stmt3->bindParam(5,$_POST['s_name']);
		 $stmt3->bindParam(6,$_POST['s_sec']);

		if ($stmt3->execute()) {
			setcookie('add_success',1,time()+5,'/');
			echo "<script type='text/javascript'> window.location.href = 'admin_home.php';</script>";
		} else {
			setcookie('add_fail',1,time()+5,'/');
			echo "<script type='text/javascript'> window.location.href = 'detail_class.php?c_id'".$rowCId['c_id']."'';</script>";
		}

	}elseif ($rowPass != $pass) {
		setcookie('add_fail',1,time()+5,'/');
		echo "<script type='text/javascript'> window.location.href = 'detail_class.php?c_id'".$rowCId['c_id']."'';</script>";
	}
?>