<?php 
	include '../connect.php'; 
	session_start();
	$stmt = $pdo->prepare("SELECT * FROM student WHERE s_id = ?");
	$stmt->bindParam(1,$_SESSION["username"]);
	$stmt->execute();
	while ($row=$stmt->fetch()) {
	 	$rowUser["s_id"] = $row["s_id"];
	 	$rowPassword["s_password"] = $row["s_password"];
	 	$rowName["s_name"] = $row["s_name"];
	 } 

	$stmt2=$pdo->prepare("SELECT * FROM classroom");
	$stmt2->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Class</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

	<!-- Navbar --> 
	<nav class="navbar sticky-top navbar-light navbar-expand-lg" style="background-color: #747d8c;">
 		<a class="navbar-brand text-light" href="#">CheckClassroom</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
    	</button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Link</a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Dropdown
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#">Action</a>
		          <a class="dropdown-item" href="#">Another action</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="#">Something else here</a>
		        </div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link disabled" href="#">Disabled</a>
		      </li>
		    </ul>
		    <div class="form-inline my-2 my-lg-0 mr-sm-2 col-md-2">
		    	<a href="" class="btn btn-primary  dropdown-toggle col-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user-tie"></i> <?= $_SESSION["name"] ?> </a>
		    	<div class="dropdown-menu col-10">
		    		<button class="dropdown-item" data-target="#profile" data-toggle="modal"> ข้อมูลส่วนตัว </button>
		    		<button class="dropdown-item" data-target="#editProfile" data-toggle="modal"> แก้ไขข้อมูลส่วนตัว </button>
		    		<div class="dropdown-divider"></div>
		    		<a href="../admin/admin_logout.php" class="dropdown-item"> ออกจากระบบ </a>
		    	</div>
		    </div>
		  </div>
	</nav>

	<!-- Modal Profile -->
	<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content " style="box-shadow: 0px 0px 50px 25px #1e272e;">
		      <div class="modal-header">
		        <h3 class="modal-title" id="exampleModalLabel">Profile</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      	<div class="modal-body" style="background-color: #636e72; padding: 50px;">
			       	<?= $rowUser["l_username"] ?><br>
			       	<?= $rowPassword["l_password"] ?>
		      </div>		      
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

	<!-- Modal EDIT Profile -->
	<form action="editPrfile.php" method="post">
	<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content " style="box-shadow: 0px 0px 50px 25px #1e272e;">
		      <div class="modal-header">
		        <h3 class="modal-title" id="exampleModalLabel">Profile</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      	<div class="modal-body" style="background-color: #636e72; padding: 50px;">
			       	<?= $rowUser["l_username"] ?><br>
			       	<?= $rowPassword["l_password"] ?>
		      </div>		      
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>

	<div style="min-height: 850px;background-color: #ecf0f1;">
		<?php while ($row2=$stmt2->fetch()) { ?>
			<div style="background-color: #feca57; padding-top: 20px; padding-bottom: 20px;">
				<div class="form-group" style="text-align: center;">
					<label style="font-size: 30px;"> <?= $row2['c_id'] ?> </label> &nbsp; <label style="font-size: 30px;">  <?= $row2['c_name'] ?> </label>
				</div><br>
				<div class="form-group" style="text-align: center;">
					(&nbsp;<label style="font-size: 30px;"><?=$row2['c_term']?></label>&nbsp;/&nbsp;<label style="font-size: 30px;"><?=$row2['c_year']?></label>&nbsp;)
				</div>
			</div>
			<div style="background-color: #ff9ff3; min-height: 700px;width: 300px; padding-top: 50px;padding-bottom: 50px;">
				<div class="form-group mb-3 justify-content-center" style="text-align: center;">
					<button class="btn btn-primary btn-lg col-10"> ดูรายชื่อนักศึกษา </button>
				</div>				
				<div class="form-group mb-3 justify-content-center" style="text-align: center;">
					<button class="btn btn-primary btn-lg col-10"> ดูยอดการเข้าชั้นเรียน </button>
				</div>
				<?php if ($rowPer['permission'] == 1) { ?>
					<div class="form-group mb-3 justify-content-center" style="text-align: center;">
						<button class="btn btn-primary btn-lg col-10"> เพิ่มสิทธิ์การเข้าถึง </button>
					</div>	
				<?php } ?>
				<div class="form-group mb-3 justify-content-center" style="text-align: center;">
					<a href="admin_home.php" class="btn btn-danger btn-lg col-10"> ย้อนกลับ </a>
				</div>				
			</div>			
		<?php } ?>
	</div>


	<footer style="background-color: #747d8c; padding: 24px;">
		<div style="text-align: center;">
			<label style="font-size: 18px; color: white; padding: 9px;">@Copyright By 5 สหายคล้ายจะเป็นลม</label>
		</div>		
	</footer>

</body>
</html>