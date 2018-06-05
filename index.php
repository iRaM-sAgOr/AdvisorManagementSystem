<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Login Form</h2></center>
			<div class="imgcontainer">
				<img src="imgs/avatar.png" alt="Avatar" class="avatar">
			</div>
		<form action="index.php" method="post">
		
			<div class="inner_container">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				
				<p><b>User Type:</b></p>
				 <select name="type">
                 <option value="teacher">Teacher</option>
                  <option value="student">Student</option>
    
                   </select>
		
				
		     		<button class="login_button" name="login" type="submit">Login</button>
				    <a href="student_registration_page.php">
					<button type="button" class="register_btn">Register(Student)</button></a>
					<a href="teacher_registration_page.php">
					<button type="button" class="register_btn">Register(Teacher)</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['login']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				@$type=$_POST['type'];
				if(@$username=="Sagor" || @$username=="Fahim" || @$username=="Rema"){
                   $_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
                     header( "Location: Admin_page.php");
				}
				else if($type=='teacher'){
					$query = "select * from teacher where username='$username' and password='$password' ";
				}
				else{
					$query = "select * from userinfotbl where username='$username' and password='$password' ";
				}
				
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					if($type=='student'){
                        
						//header("Location: student_view_page.php");
						$query = "select sid from userinfotbl where username='$username' and password='$password' ";
						$query_run = mysqli_query($con,$query);
						$data=mysqli_fetch_array($query_run);
						$_SESSION['sid'] = $data['sid'];
						$teacher="student";
                        $_SESSION['teacher']=$teacher;
						header( "Location: student_profile_view.php");
					}
						else{
						$query = "select tid from teacher where username='$username' and password='$password' ";
						$query_run = mysqli_query($con,$query);
						$data=mysqli_fetch_array($query_run);
						$_SESSION['tid'] = $data['tid'];
					header( "Location: teacher_profile_view.php");
					}
					}
		            else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
			
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
				
			}
			
		?>
		
	</div>
</body>
</html>