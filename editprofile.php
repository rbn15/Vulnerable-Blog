<?php
session_start();

$error=-1;
if(isset($_GET["error"])){
	$error=$_GET["error"];
}

if(!(isset($_SESSION['usr']))){
	header("Location: login.php");
}
$conn=mysqli_connect('localhost','root','','blog');
	if (!$conn) {
		die("The Connection to the database was not established");
	}

//extracting the uid for further operations
$q="select * from info where usr='".$_SESSION["usr"]."'";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($res);
$uid=$row["uid"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<script type="text/javascript">
		function delete_usr(){
			var res=confirm("Are you sure?");
			if(res==true){
				document.location.href="deleteuser.php";
			}
		}
	</script>
	<link rel="stylesheet" type="text/css" href="c1.css">
</head>
<body>
<h1>Blog</h1>
<h2>Edit Profile</h2>
<h2><?php echo $_SESSION["usr"]; ?></h2>
<table>
<form action="applyeditprofile.php" method="post">
	<input type="hidden" value=<?php echo $uid?> name="uid">
	<tr><td>Username</td><td><input type="text" name="usr" value=<?php echo $row["usr"]?> placeholder="Username" required="true"></td></tr>
	<?php
		if($error==2){echo "Username already taken";}
	?>
	<tr><td>First Name</td><td><input type="text" value=<?php echo $row["firstname"];?>  name="firstname" placeholder="firstname" required="true"></td></tr>
	<tr><td>Last Name</td><td><input type="text"  value=<?php echo $row["lastname"]; ?> name="lastname" placeholder="lastname" required="true"></td></tr>
	<tr><td>Password</td><td><input type="password" name="password" placeholder="Password" required="true"></td></tr>
	<?php
	if($error==1){
		echo "Password should be of minimum 8 characters";
	}
	?>
	<tr><td>Email Address</td><td><input type="text"  value=<?php echo $row["email"]?> name="email" required="true"></td></tr>
	<tr><td><button>Submit</button></td></tr>
</form>


<tr><td><button onclick="delete_usr()">Delete Profile</button></td></tr>
</table>
<br>
<a href="dashboard.php">Back</a>

</body>
</html>