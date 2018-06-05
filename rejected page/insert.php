<?php  
 $connect = mysqli_connect("localhost", "root", "", "logindb");  
 $sql = "INSERT INTO userinfotbl Select * from student_request where sid = '".$_POST["id"]."'"; 
 $sql1 = "DELETE FROM student_request WHERE sid = '".$_POST["id"]."'"; 
 //"INSERT  into student_request values('$username','$password','$email','$sid','$tel','$pic','$type')";
 if(mysqli_query($connect, $sql) && mysqli_query($connect, $sql1))  
 {  
      echo 'Data Inserted';  
 }  
 ?> 