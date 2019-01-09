<!--Signup using MySQL connect to database-->
<?php
session_start();
$uid=$_POST["uid"];
$usr=$_POST["usr"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$password=$_POST["password"];
$email=$_POST["email"];
//check if password is of length 8 or more
if(strlen($password)<8){
	header("Location: login.php/?error=1");
}

//establish connection to db
$conn=mysqli_connect('localhost','root','','blog');
if (!$conn) {
	die("The Connection to the database was not established");
}
//check if username available


//input values into the database
$password=md5($password);
$q="update info set usr='".$usr."',firstname='".$firstname."',lastname='".$lastname."',email='".$email."' where uid=".$uid.";";

$q2="update credentials set hash='".$password."' where uid=".$uid.";";
echo $q."<br>".$q2;
mysqli_query($conn,$q);
mysqli_query($conn,$q2);
$_SESSION["usr"]=$usr;
header("Location: editprofile.php");
?>
