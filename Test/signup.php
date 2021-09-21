<!DOCTYPE html>
<?php 
session_start();
include("connection.php");
$sql = "SELECT * FROM signup";
$res = $conn->query($sql);
$num = mysqli_num_rows($res)+1;
if(isset($_POST['create'])){
$id="S".$num;
$name=$_POST['uname'];
$pass=$_POST['pass'];
$error=array();
if(empty($name)){
$error['ac']="Enter Firstname";
}
elseif (empty($pass)) {
$error['ac']="Enter Firstname";
}


if(count($error)==0){
$query="INSERT INTO signup(SID, email, password) VALUES 
('".$id."','".$name."','".$pass."')";
$res=mysqli_query($conn,$query);
if($res){
header('Location:login.php');
}
else{
echo "<script>alert('failed')</script>";
} } }
?>
<html>
<head>
<title>Create Account</title>
</head>
<body>
<?php 
include("home.php");
?>
<div class="container-fluid">
<div class="col-md-12">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 my-5 jumbotron">
<h5 class="text-center my-3">Create Account</h5>
<form method="post">
<div class="form-group">
<label>Username</label>
<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Student Name">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Your Password">
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="cpass" 
class="form-control" autocomplete="off" placeholder="Enter Your Password">
</div>

<input type="submit" name="create" class="btn btn-success my-3" value="Create Account">
<p><b>I already have an account</b><a 
href="login.php" ><kbd class="text text-info">Click here.</kbd></a></p>
28
</form>
 <code style="font-size: 25px">&it;&gt;If you already have an account directly go to 
the login page&it;&gt;</code>
</div>
<div class="col-md-3"></div>
</div>
</div>
</div>
</body>
</html>