<?php
session_start();
if(!isset($_SESSION["usr"])){
	header("Location: login.php");
	die();	
}

$conn=mysqli_connect('localhost','root','','blog');
if (!$conn) {
	die("The Connection to the database was not established");
}
$page=$_POST["page"];
$uid=$_POST["uid"];
$bid=$_POST["bid"];
$q="insert into likes (bid, uid) values(".$bid.",".$uid.");";

mysqli_query($conn,$q);
header("Location: ".$page."");
?>