
 <?php  
 $connect = mysqli_connect("localhost", "root", "", "logindb");  
 $sql = "DELETE FROM student_request WHERE sid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>