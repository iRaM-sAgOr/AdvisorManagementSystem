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
	<center><h2>You Are Getting Registered As a Student</h2></center>
		<form action="student_registration_page.php" method="post" enctype="multipart/form-data" >
			<div class="imgcontainer">
				<img src="imgs/p.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="usrname" required>
				
				<label><b>E-mail</b></label>    
                <input type = "email" name = "email" placeholder="Enter Email" required />
				
				<label><b>User-Id</b></label>    
                <input type = "id" name = "sid" placeholder = "Enter Id" required/>   
				
				 <label><b>Mobile Number</b></label>    
                 <input type = "tel" name = "tel" placeholder = "Enter Mobile Number" required/>   
				
				<div class = "form_group">
                <p><b>Upload the Image</b></p>
                <input type="file"  name="pic" accept="image/*">
                </div>
				
				<label><b>Pasword</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				
				<label><b>Confirm Password</b></label>
				<input type="password" placeholder="Enter Password" name="cpassword" required>
				
				<label><b>Supervised by:</b></label>
				<br></br>

         <?php
         ///Dynamically fetch the current registered teachers name by admin........
         $query="select * from teachers_identity";
         $query_run = mysqli_query($con,$query);
         echo "<select name='sir'>";
          while($data=mysqli_fetch_array($query_run)){
         	
             echo "<option value='{$data["tid"]}'>";
             echo $data['username'];
                 echo '</option>';
    }
                  echo ' </select>';
                   
   
?>
				
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
				@$sid=$_POST['sid'];
				@$tel=$_POST['tel'];
				@$type=$_POST['sir'];
				
                
             
				//echo $type;
				if($password==$cpassword)
				{
					//echo '<script type="text/javascript">alert("value is $type!")</script>';
				
					
					     $query = "select * from userinfotbl where sid='$sid'";
					     //echo $query;
				         $query_run = mysqli_query($con,$query);
				         //echo mysql_num_rows($query_run);
				          if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
						}
						else
						{
							//Photo file upladed in a folder for furthe requirement.Not to fetch from database directly.from the folder of the server.
                         $pic=$_FILES['pic']['name'];//pic is the name attribute of image option 
                         $target = "imgs/".basename($pic);//imgs is the folder name.
                         
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
                            if(move_uploaded_file($_FILES['pic']['tmp_name'], $target) && $uploadOk==1)//if the file is uploaded in the imgs folder then okay and size ,type also
                            {
							$query = "INSERT  into student_request values('$username','$password','$email','$sid','$tel','$pic','$type')";
							$query_run = mysqli_query($con,$query);
							if($query_run   )
							{
								$teacher="student";
                                $_SESSION['teacher']=$teacher;
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								$_SESSION['sid'] = $sid;
								header( "Location: student_registration_page.php");
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
							}
							else
							{
									
								
							
							    echo '<script type="text/javascript">alert("Registration Unsuccessful due to server error. Please try later.")</script>';
						
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