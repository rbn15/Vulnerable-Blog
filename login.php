<?php
$error=-1;
if(isset($_GET["error"])){
	$error=$_GET["error"];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="c1.css">
</head>
<body>
<h1>Blog</h1>
<!--Sign In-->
<h2>Sign In</h2>

<table>
	<form action="loginaction.php" method="post">
	<tr><td>Username</td><td><input type="text" name="usr" placeholder="Username"></td></tr>
	<tr><td>Password</td><td><input type="password" name="password" placeholder="Password"></td></tr>
	<?php
	if($error==3){
		echo "Wrong Password or Username";
	}
	?>
	
	<tr><td><input type="Submit" name="signin" value="Sign In"></td></tr>
	</form>
</table>

<!--Sign up-->
<h2>Sign up</h2>
<table>
<form action="signup.php" method="post">
	<tr><td>Username</td><td><input type="text" name="usr" placeholder="Username" required="true"></td></tr>
	<?php
		if($error==2){echo "Username already taken";}
	?>
	<tr><td>First Name</td><td><input type="text" name="firstname" placeholder="firstname" required="true"></td></tr>
	<tr><td>Last Name</td><td><input type="text" name="lastname" placeholder="lastname" required="true"></td></tr>
	<tr><td>Email Address</td><td><input type="text" name="email" placeholder="email@address.com" required="true"></td></tr>
	<tr><td>Password</td><td><input type="password" name="password" placeholder="minimum 8 characters" required="true"></td></tr>
	<?php
	if($error==1){
		echo "Password should be of minimum 8 characters";
	}
	?>
	<tr><td><button>Submit</button></td></tr>
</form>
</body>
</html>