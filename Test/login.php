<?php 
session_start();
?>
<?php 
include("home.php");
?>
<?php 
include("connection.php");
?>
<!DOCTYPE html>
<?php 
if(isset($_POST['login'])){
$sname=$_POST['sname'];
$password=$_POST['pass'];
if (empty($sname)) {
echo "<script>alert('Enter Username')</script>";
echo '<style><div class="alert alert-success ">you successfully loged 
in</div></style>';
}
elseif (empty($password)) {
echo "<script>alert('Enter password')</script>";
}
else if(!empty($sname) && !empty($password)){
$query="SELECT * FROM signup WHERE email='".$sname."' 
AND password='".$password."'";
$res=$conn->query($query);
if(mysqli_num_rows($res)>=0){
while($r=$res->fetch_assoc())
{
$id = $r['SID'];
}
$_SESSION['name']=$sname;
$_SESSION['id']=$id;
echo "<script>alert('hi you login as student')</script>";
header("Location:index.php");
exit(); 
}else{
echo "<script>alert('Invalid credintials')</script>";
} } }
?>
<html>
<head>
<title>Student Login Page</title>
</head>
<body>
<div class="container-fluid">
<div class="col-md-12">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 my-5 jumbotron">
<h5 class="text-center my-3">Login</h5>
<form action="" method="POST">
<div class="form-group">
<label>Email</label>
<input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter Email">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
</div>
<input type="submit" name="login" class="btn btn-success 
my-3" value="Login">
<a href="index.php">.</a>
<p><b>I dont have an account </b><a href="signup.php" 
><kbd class="text text-info">Click here.</kbd></a></p>
</form>
</div>
<div class="col-md-3"></div>
</div>
</div>
</div>
</body>
</html>