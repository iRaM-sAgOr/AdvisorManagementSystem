<?php  
 $connect = mysqli_connect("localhost", "root", "", "logindb");  
 $output = '';  
 $sql = "SELECT * FROM student_request ORDER BY sid DESC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered" table-layout: auto;
    width: 100% border-collapse: collapse; >  
                <tr>  
                     <th width="" >Student Id</th>  
                     <th width="" >Student Name</th>  
                     <th width="" >Supervisor</th>  
                     <th width="" >Email</th>  
                     <th width="" >M-Number</th> 
                     <th width="" >Delete</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
        $tec_id=$row['tid'];
        $sql1 = "SELECT username FROM teachers_identity where tid='$tec_id'"; 
        $result1 = mysqli_query($connect, $sql1);
        $row1 = mysqli_fetch_array($result1);
           $output .= '  
                <tr>  
                     <td>'.$row["sid"].'</td>  
                     <td class="first_name" data-id1="'.$row["sid"].'" contenteditable>'.$row["username"].'</td>  
                     <td class="last_name" data-id2="'.$row["sid"].'" contenteditable>'.$row1["username"].'</td>  
                     <td class="first_name" data-id3="'.$row["sid"].'" contenteditable>'.$row["email"].'</td>  
                     <td class="last_name" data-id4="'.$row["sid"].'" contenteditable>'.$row["tel"].'</td> 
                     <td><button type="button" name="delete_btn" data-id5="'.$row["sid"].'" class="btn btn-xs btn-danger btn_delete">Delete</button>
                     <button type="button" name="btn_add" id="btn_add" data-id6="'.$row["sid"].'" class="btn btn-xs btn-success">Accept</button></td>  
                </tr>  
           ';  
      }  
     
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="6">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>