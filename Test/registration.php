<?php
session_start();
include("connection.php");
$sql = "select * from signup";
$res=$conn->query($sql);
$num = mysqli_num_rows($res)+1;

if(isset($_POST['register']))
{
	$id="S".$num;
	$name=$_POST['user'];
	$pass = $_POST['password'];
	$cpass=$_POST['cpassword'];
	
	if(empty($name))
	{
		$error['ac']="Enter Email";
	}
	if(empty($pass))
	{
		$error['ac']="Enter Password";
	}
	if(empty($cpass) or $cpass!=$pass)
	{
		$error['ac']="This field should be same as Password";
	}
	if(count($error)==0)
	{
		$query = "INSERT INTO signup(SID,email,password) VALUES(".$id.",".$name.",".$pass.")";
		$res=mysqli_query($conn,$query);
		if($res)
		{
			header("Location: login.php");
			echo "Please Login!!";
		}
		else
		{
			echo "<script>alert('failed')</script>";
		}
	}
}

if(isset($_POST['login']))
{
	$name = $_POST['user'];
	$pass = $_POST['password'];
	if(empty($name) || empty($pass))
	{
		echo "Please Enter username/password";
	}
	else{
	$query = "SELECT * FROM signup WHERE email = '".$name."' AND password = '".$pass."';";
	$res=$con->query($query);
	if(mysqli_num_rows($res)>=0)
	{
		while($r=$res->fetch_assoc())
		{
			$id=$r['SID'];
		}
		$_SESSION['id']=$id;
		header("Location:../index.php");
	}
	}
}
?>