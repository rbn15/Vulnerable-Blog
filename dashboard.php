<?php
session_start();
if(!(isset($_SESSION['usr']))){
	header("Location: login.php");
}
$conn=mysqli_connect('localhost','root','','blog');
if (!$conn) {
	die("The Connection to the database was not established");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="c1.css">
</head>
<body>
<h1>Blog</h1>
<h2>Dashboard</h2>
<a href="index.php">Home</a>
<a href="logout.php">Logout</a>
<a href="editprofile.php">Edit Profile</a>


<?php
echo "<h2>".$_SESSION['usr']."</h2>";
?>
<h2>New Blog Post</h2>
<form action="blogpost.php" method="POST">
<input type="text" name="title" placeholder="Post Name"><br>
<textarea name="essay" placeholder="New Blog Post" rows="4" cols="65"></textarea><br>
<button>Add post</button>
</form>
<h2>Blog Posts</h2>
<!--all the user's previous posts have to appear here-->
<?php
//finding the uid for further operations
$q="select uid from info where usr='".$_SESSION["usr"]."'";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($res);
$uid=$row["uid"];

$q1="select * from blogs where uid=".$uid.";";
$res=mysqli_query($conn,$q1);
while ($row=mysqli_fetch_assoc($res)) {
	echo "<h3>".$row["title"]."</h3><h4>".explode(".",$row["timestamp"])[0]."</h4><p id='para'>".$row["essay"]."</p>";
	//like button
	//for the like button to change to 'Liked' we will have to check in the db 

	$q2="select * from likes where uid=".$uid." and bid=".$row["bid"].";";
	
	$res2=mysqli_query($conn,$q2);
	$count=mysqli_num_rows($res2);
	if($count<=0){ 
		echo "
			<form action='liked.php' method='POST'>
				<input type='hidden' name='page' value='".$_SERVER["REQUEST_URI"]."'>
				<input type='hidden' name='bid' value='".$row["bid"]."'>
				<input type='hidden' name='uid' value='".$uid."'>
				<input type='submit' value='Like'> 
			</form>
		";
	}
	else{

		//showing the number of likes
		$q3="select * from likes where bid=".$row["bid"].";";
	
		$res3=mysqli_query($conn,$q3);
		$count=mysqli_num_rows($res3);


		echo "<button>".$count." Likes</button>";
	}
	echo "<hr>";
}
//the timestamp has been made less specific only displaying till seconds
?>

</body>
</html>