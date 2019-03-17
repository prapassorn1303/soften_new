<?php 
		include "../connect.php";

		session_start();

		$username = $_POST["username"];
		$password = $_POST["password"];

		$stmt1 = $pdo->prepare("SELECT * FROM teacher WHERE l_username = ? AND l_password = ?");
  		$stmt1->bindParam(1, $username);
  		$stmt1->bindParam(2, $password);
  		$stmt1->execute();
  		$row1 = $stmt1->fetch();

  		$stmt2 = $pdo->prepare("SELECT * FROM student WHERE s_id = ? AND s_password = ?");
  		$stmt2->bindParam(1, $username);
  		$stmt2->bindParam(2, $password);
  		$stmt2->execute();
  		$row2 = $stmt2->fetch();

  		if (!empty($row1)) {
        setcookie('login_success',1,time()+5,'/');
  			$_SESSION["username"] = $row1["l_username"];
  			$_SESSION["name"] = $row1["l_name"];
        $_SESSION["permission"] = $row1["permission"];
  			echo "<script type='text/javascript'> window.location.href = '../admin/admin_home.php';</script>"; 				
  		}
		elseif (!empty($row2)) { 
      setcookie('login_success',1,time()+5,'/');
			$_SESSION["username"] = $row2["s_id"];
			$_SESSION["name"] = $row2["s_name"];
      $_SESSION["permission"] = $row2["permission"];
			echo "<script type='text/javascript'> window.location.href = '../student/student_home.php';</script>";
		} 
    elseif (empty($row1) && empty($row2)) {
      setcookie('login_error',1,time()+5,'/');
      echo "<script type='text/javascript'> window.location.href = '../index.php';</script>";
    }
	?>			
