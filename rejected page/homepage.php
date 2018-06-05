<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/style.css">
</head>
 <style>
        table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
              } 
        th {
         background-color: #588c7e;
         color: white;
           }
        tr:nth-child(even) {background-color: #f2f2f2}
 </style>

<body>
	  <div id="main-wrapper">
		 <center><h2>Student Under Your Supervision Sir</h2></center>
		 <center><h3>Welcome <?php echo $_SESSION['username']; ?></h3></center>
		
		 <form action="" method="post">
			  <div class="imgcontainer">
				 <img src="imgs/t.png" alt="Avatar" class="avatar">
			  </div>

   <table>
    <tr>
     <th>Student-Name</th> 
     <th>Student-Id</th>
    </tr>

 <?php

       if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
       } 
        $sql = "SELECT  username, sid FROM userinfotbl ";
        $result = $con->query($sql);
      if ($result->num_rows > 0) {
   // output data of each row
      while($row = $result->fetch_assoc())
     {
      echo "</td><td>" . $row["username"] . "</td><td>". $row["sid"]. "</td></tr>";
      }
   echo "</table>";
      } 
   else { echo "0 results"; }
   $con->close();
   ?>
</table>
</body>
</html>
			
			<div class="inner_container">
      
				<button class="logout_button" name="logout"  value="logout" type="submit">Log Out</button>
        	
			</div>
		</form>
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