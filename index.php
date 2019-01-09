<!--The blog as seen by outside users-->
<!--Need GET method inputs to show the right blog page-->
<?php
session_start();
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
<a href="dashboard.php">Dashboard</a>

<?php
if(isset($_SESSION["usr"])){
echo "<a href='logout.php'>Logout</a><br>";
}
else
{
	echo "<a href='login.php'>Sign In</a><br>";
}

if(isset($_SESSION['usr'])){
echo "<h2>".$_SESSION['usr']."</h2>";
//present user's uid extracted
$q="select uid from info where usr='".$_SESSION["usr"]."'";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($res);
$uid2=$row["uid"];
}
?>
Search your favourite blogger
<form action="index.php" method="GET">
<input type="text" name="page">
<button>Search</button>
</form>
<?php
if(isset($_GET["page"]))
{
	$page=$_GET["page"];
//check for page in database

//finding uid of the owner of the blog
	$q="select uid from info where usr='".$page."'";
	$res=mysqli_query($conn,$q);

	if ($row=mysqli_fetch_assoc($res)){
		$uid=$row["uid"];
		echo "<br>You are viewing ".$page."'s page";
		$q1="select * from blogs where uid=".$uid.";";
		$res=mysqli_query($conn,$q1);
		while ($row=mysqli_fetch_assoc($res)) {
			echo "<h3>".$row["title"]."</h3><h4>".explode(".",$row["timestamp"])[0]."</h4><p id='para'>".$row["essay"]."</p>";
			//like button
			//for the like button to change to 'Liked' we will have to check in the db 

			$f=0;
			if(isset($_SESSION["usr"])){
			$q2="select * from likes where uid=".$uid2." and bid=".$row["bid"].";";
			
			$res2=mysqli_query($conn,$q2);
			$count=mysqli_num_rows($res2);
			if($count<=0 && isset($_SESSION["usr"])){ 
				echo "
					<form action='liked.php' method='POST'>
						<input type='hidden' name='page' value='".$_SERVER["REQUEST_URI"]."'>
						<input type='hidden' name='bid' value='".$row["bid"]."'>
						<input type='hidden' name='uid' value='".$uid2."'>
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


	}
	else{
		echo "<br>No blog page found for username='".$page."'";
	}
}

?>
</body>
</html>