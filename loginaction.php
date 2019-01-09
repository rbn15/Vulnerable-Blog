<?php
	$usr=$_POST["usr"];
	$psw=$_POST["password"];
	session_start();
	//establish connection to db
	$conn=mysqli_connect('localhost','root','','blog');
	if (!$conn) {
		die("The Connection to the Database was not established");
	}
	
	//if username password matches then assign the session variables
	$q="select uid, hash from credentials where uid=(select uid from info where usr='".$usr."');";
	echo $q;
	$res=mysqli_query($conn,$q);
	//for security reasons we are matching the md5 hashes
	if(!$res){
		header("Location: login.php?error=3");
	}
	
	$row=mysqli_fetch_assoc($res);
	$pswdb=$row["hash"];
	
	$psw=md5($psw);
	
	if($psw==$pswdb){
			$_SESSION["usr"]=$usr;
			echo "password matched";
	}
	else{
		header("Location: login.php?error=3");
		die();
	}
	header("Location: index.php");
?>