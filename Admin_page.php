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
	<center><h3>Welcome <?php echo $_SESSION['username']; ?></h3></center>
		<form action="Admin_page.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/p.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label><b>Teacher's Name</b></label>
				<input type="text" placeholder="Enter Username" name="usrname" required>
                <br><br>
                <label><b>Teacher's ID</b></label>
				<input type="id" placeholder="Enter ID" name="id" required>
                <br><br>
				<button name="register" class="sign_up_btn" type="submit">Entry</button>
				
				<a href="index.php"><button type="button" class="back_btn"><< Back to Login</button></a>
				<a href="Table_page.php"><button type="button" class="back_btn"> Show the Request>></button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				@$username=$_POST['usrname'];
				@$id=$_POST['id'];
				if(1)
				{
					//echo '<script type="text/javascript">alert("value is $type!")</script>';
				
					
					     $query = "select * from teachers_identity where tid='$id'";
					     //echo $query;
				         $query_run = mysqli_query($con,$query);
				         //echo mysql_num_rows($query_run);
				          if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This User ID Already exists.. Please try another userid!")</script>';
						}
						else
						{
							$query = "insert into teachers_identity (username,tid) values('$username','$id')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
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
<?php
if(!empty($_POST["logout"])) {
  $_SESSION["user_id"] = "";
   header('Location: index.php');
  session_destroy();
}
?>