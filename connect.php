<?php
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=soften;
			charset=utf8","root","");
	}catch(PDOException $e){
		echo "เกิดข้อผิดพลาด :".$e->getMessage();
	}
?>