<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();

if (!$con) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

$sql = 'SELECT * 
		FROM userinfotbl';
		
$query = mysqli_query($con, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Displaying Student Data in HTML Table</title>
	<style type="text/css">
	img {
    border-radius: 50%;
    border: 1px solid #ddd;
    
    padding: 5px;
    width: 150px;
}
img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
</head>
<body>
	<h1>Student Profile Page</h1>
	<table class="data-table">
		<caption class="title"><b>Welcome <?php echo $_SESSION['username']; ?></b></caption>

      <form action="" method="post">
      <div class="imgcontainer">
      <?php
      $pp=$_SESSION['sid'];
     
          $query="select pic from userinfotbl where sid='$pp' ";
         $query_run = mysqli_query($con,$query);
          while($data=mysqli_fetch_array($query_run)){
             
            // echo "<img src="$data['pic']" >;
            $image=$data['pic'];
              // echo '<img src="imgs/.$image" alt="Avatar" class="avatar">';
             // echo "<img src='imgs/".$image."'>";
               echo "<img src=imgs/".$image." width='200' height='200'  alt='Loading!!'  >";
           }
                           
        ?>

		<thead>
			<tr>
				<th>NO</th>
				<th>NAME</th>
				<th>EMAIL</th>
				<th>ID</th>
				<th>PASSWORD</th>
				<th>TELIPHONE</th>
			</tr>
		</thead>
		<tbody>

		<?php
		$no 	= 1;
		//$total 	= 0;
		$amarnam=$_SESSION['username'];
		$sql = "SELECT * 
		FROM userinfotbl where sid='$pp'";
		
        $query = mysqli_query($con, $sql);
		while ($row = mysqli_fetch_array($query))
		{
			//$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['sid'].'</td>
					<td>'.$row['password'].'</td>
					<td>'.$row['tel'].'</td>
				</tr>';
			//$total += $row['amount'];
			$no++;
		}?>

		</tbody>
		<tfoot>
			<tr>
				<?php
              if($_SESSION['teacher']=="teacher"){
              	echo "<th colspan='4'></th>";
               echo "<th><a href='teacher_profile_view.php'>
               <button class='logout_button' name='Back'  value='Back' type='button'>Back</button></th>";
               //<a href="index.php"><button type="button" class="back_btn"><< Back to Login</button></a>
              }
              else
              	echo "<th colspan='5'></th>";
				?>
				
				<th><button class="logout_button" name="logout"  value="logout" type="submit">Log Out</button></th>
				
      
				
        	
			   //</div>
			</tr>
		</tfoot>
	</table>
</body>
</html>
<?php
if(!empty($_POST["logout"])) {
  $_SESSION["user_id"] = "";
   header('Location: index.php');
  session_destroy();
}
?>