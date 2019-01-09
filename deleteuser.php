<?php
session_start();
//establish connection to db
$conn=mysqli_connect('localhost','root','','blog');
if (!$conn) {
	die("The Connection to the database was not established");
}

if (isset($_SESSION["usr"])){

	$q2="select uid from info where usr='".$_SESSION["usr"]."'";
	$res2=mysqli_query($conn,$q2);
	$row=mysqli_fetch_assoc($res2);
	$uid=$row["uid"];

	$q="delete from info where uid=".$uid.";";
	
	$q3="delete from credentials where uid=".$uid.";";
	

	$q4="delete from blogs where uid=".$uid.";";

	$q5="delete from likes where uid=".$uid.";";
	
	//echo $q."<br>".$q3."<br>".$q4;
	$res5=mysqli_query($conn,$q5);
	$res4=mysqli_query($conn,$q4);
	$res3=mysqli_query($conn,$q3);

	$res=mysqli_query($conn, $q);

	session_destroy();

	header("Location: index.php");
}
else{
		header("Location: index.php");
}
?>
