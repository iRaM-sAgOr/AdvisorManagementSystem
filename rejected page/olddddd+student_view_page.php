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
		 <center><h2>Student Profile Page</h2></center>
		 <center><h3>Welcome <?php echo $_SESSION['username']; ?></h3></center>
		
		 <form action="" method="post">
      <div class="imgcontainer">
      <?php
      $pp=$_SESSION['username'];
     
     $query="select pic from userinfotbl where username='$pp' ";
         $query_run = mysqli_query($con,$query);
          while($data=mysqli_fetch_array($query_run)){
             
            // echo "<img src="$data['pic']" >;
            $image=$data['pic'];
              // echo '<img src="imgs/.$image" alt="Avatar" class="avatar">';
             // echo "<img src='imgs/".$image."'>";
               echo "<img src=imgs/".$image." width=100 height=100 alt=Loading!! class ='avatar'>";
    }
                  
         
       
        //</div>          
           
       
      ?>
			 
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