<?php
session_start();
require 'connection.php';
if(isset($_POST['submit']))
{
	$sid = $_SESSION['id'];
	copy($_FILES['jsonFile']['tmp_name'],'jsonFiles/'.$_FILES['jsonFile']['name']);
	$data = file_get_contents('jsonFiles/'.$_FILES['jsonFile']['name']);
	$val = (array)json_decode($data,true);
	$stmt = mysqli_prepare($conn,'insert into table1(SID,userId,id,title,body) values(?,?,?,?,?)');
	
	mysqli_stmt_bind_param($stmt,'sssss',$sid,$userId,$id,$title,$body);
	
	foreach($val as $row)
	{
		$userId = $row['userId'];
		$id = $row['id'];
		$title = $row['title'];
		$body = $row['body'];
		mysqli_stmt_execute($stmt);
	}
}

if(isset($_POST['display']))
{
	$sid = $_SESSION['id'];
	$sql = "SELECT id,userId,title,body from table1 WHERE SID ='".$sid."' ORDER BY id;";
	$no = 1;
	echo "<table class='table thead-light table-primary' align='center'>";
echo "<tr>";
echo "<th>S.no</th>";
echo "<th> ID </th>";
echo "<th> USER ID </th>";
echo "<th> TITLE </th>";
echo "<th> BODY </th>";
echo "</tr>";
if($result = $conn->query($sql))
{
while($row=$result->fetch_assoc())
{
echo "<tr>";
echo "<td>".$no."</td>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['userId']."</td>";
echo "<td>".$row['title']."</td>";
echo "<td>".$row['body']."</td>";
echo "</tr>";
$no = $no+1;
}
echo "</table>";
echo "</div>";
$no=1;
$result->free();
$ans ='';
}
}
?>
<?php 
include("home.php");
?>
<html>
<head>
<title>File Upload</title>
</head>
<body>
<div class="container-fluid">
<div class="col-md-12">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 my-5 jumbotron">
<h5 class="text-center my-3">Upload JSON File</h5>
<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label>Select File</label>
<input type="file" name = "jsonFile" class="form-control" autocomplete="off" placeholder="Enter Email">
</div>
<input type="submit" name="submit" value="upload" class="btn btn-success 
my-3" value="Login">                         <input type="submit" name="display" value="Display Value" class="btn btn-success 
my-3" value="Login">
<a href="index.php">.</a>
</form>
</div>
<div class="col-md-3"></div>
</div>
</div>
</div>

</body>
</html>