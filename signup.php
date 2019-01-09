<!--Signup using MySQL connect to database-->
<?php
$usr=$_POST["usr"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$password=$_POST["password"];
$email=$_POST["email"];
//check if password is of length 8 or more
if(strlen($password)<8){
	header("Location: login.php?error=1");
}

//establish connection to db
$conn=mysqli_connect('localhost','root','','blog');
if (!$conn) {
	die("The Connection to the database was not established");
}
//check if username available
$q="select * from info where usr='".$usr."';";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($res);
if(mysqli_num_rows($res)>0){
	header("Location: login.php?error=2");
	die();
}
//input values into the database
$password=md5($password);
$q="insert into info(usr,firstname , lastname, email) values('".$usr."','".$firstname."','".$lastname."','".$email."');";

$q2="insert into credentials(hash) values('".$password."');";
echo $q."<br>".$q2;
mysqli_query($conn,$q);
mysqli_query($conn,$q2);
header("Location: login.php");
?>
