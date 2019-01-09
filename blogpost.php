<?php
session_start();

$title=$_POST["title"];
$essay=$_POST["essay"];

//establish connection to db
$conn=mysqli_connect('localhost','root','','blog');
if (!$conn) {
	die("The Connection to the database was not established");
}
//finding uid for further transaction
$q="select uid from info where usr='".$_SESSION["usr"]."'";
echo $q;
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($res);
$uid=$row["uid"];

$q1="insert into blogs(uid,title, essay) values(".$uid.",'".$title."','".$essay."');";
echo $q1;
mysqli_query($conn,$q1);
header("Location: dashboard.php");
?>