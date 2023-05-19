<?php
	session_start();
	$conn=mysqli_connect("localhost","root","","gym");

	$sql="select * from register where username='$_SESSION[username]' ";

	$result=$conn->query($sql);

	while($row=$result->fetch_assoc())
	$pic=$row['profile'];

	

?>


<html>
<head>
	<link rel="stylesheet" href="login.css">
</head>
<body>

	<div class="loginbox">
		<img src=<?php echo $pic; ?> class="avatar">
			<h1>Login Here</h1>
				<form action="log.php" method="post">
					<p>Username</P>
					<input type="text" placeholder="Enter User Name" value=<?php echo $_SESSION["username"]; ?> required="required" name="User">
					<p>Password</P>
					<input type="password" placeholder="Enter password" required="required" name="password">
					
					<p style="color:red"><?php 
						if(isset($_SESSION['error'])){
							echo "Invalid Password";
						}
					?></p>
					<br>

					<input type="submit" value="Login">
					<a href="login.php" >Back</a><br>
					<a href="#" >Forgot Password?</a><br>
					<a href="register.php" >Don`t have account?</a>
				</form>

				<?php
					unset($_SESSION['error']);
				?>
	</div>

</body>
</html>