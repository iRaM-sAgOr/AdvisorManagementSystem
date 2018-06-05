<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>You Are Getting Registered As a Teacher</h2></center>
		<form action="teacher_registration_page.php" method="post" enctype="multipart/form-data">
			<div class="imgcontainer">
				<img src="imgs/p.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="usrname" required>
				
				<label><b>E-mail</b></label>    
                <input type = "email" name = "email" placeholder="Enter Email" required />
				
				<label><b>Teacher-Id</b></label>    
                <input type = "id" name = "id" placeholder = "Enter Id" required/>   
				
				 <label><b>Mobile Number</b></label>    
                 <input type = "tel" name = "tel" placeholder = "Enter Mobile Number" required/>   
				
				<div class = "form_group">
                <p><b>Upload the Image</b></p>
                <input type="file" name="pic" accept="image/*">
                </div>
				
				<label><b>Pasword</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				
				<label><b>Confirm Password</b></label>
				<input type="password" placeholder="Enter Password" name="cpassword" required>
				
				
               <br><br>
  

				
				<button name="register" class="sign_up_btn" type="submit">Sign Up</button>
				
				<a href="index.php"><button type="button" class="back_btn"><< Back to Login</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				@$username=$_POST['usrname'];
				@$password=$_POST['password'];
				@$cpassword=$_POST['cpassword'];
				@$email=$_POST['email'];
				@$id=$_POST['id'];
				@$tel=$_POST['tel'];
				@$pic=$_POST['pic'];
				//@$type=$_POST['type'];
				
				
				if($password==$cpassword)
				{
					//echo '<script type="text/javascript">alert("value is $type!")</script>';
					
					
			             $query = "select * from teacher where tid='$id'";
			             $query2="select * from teachers_identity where tid='$id'";
					     //echo $query;
				         $query_run = mysqli_query($con,$query);
				         $query_run2 = mysqli_query($con,$query2);
				         //echo mysql_num_rows($query_run);
				        if($query_run)
					 {
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This UserId Already exists.. Please try Valid userId!")</script>';
						}
						else if(mysqli_num_rows($query_run2)==0){
							echo '<script type="text/javascript">alert("This UserId is not Valid for the Registration.. Please try Valid userId!")</script>';
						}
						else
						{
							$pic=$_FILES['pic']['name'];
                         $target = "imgs/".basename($pic);
                         
                         $uploadOk=1;
                         //////////////size check...............
                         if ($_FILES['pic']['size'] > 1000000) {
                         $uploadOk = 0;
                         }
                         /////////////type check..........
                         $imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));
                         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                         
                         $uploadOk = 0;
                         }
                        ///////////////////.......................&& move_uploaded_file($_FILES['pic']['tmp_name'], $target)
                        if(move_uploaded_file($_FILES['pic']['tmp_name'], $target) && $uploadOk==1)
                        {
							$query = "insert into teacher values('$username','$email','$password','$id','$tel','$pic')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								$_SESSION['tid']=$id;
								header( "Location: teacher_profile_view.php");
							}
							 else
		      	             {
							        	echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
					         }





					    }
					    	else
						{
							echo '<script type="text/javascript">alert("Sorry, there was an error uploading your photo.")</script>';
							
						}

					}
					   }
					         else
			                 {
				          	echo '<script type="text/javascript">alert("DB error")</script>';
					          }
					
				
				}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
				
			}
			else
			{
			}
		?>
	</div>
</body>
</html>