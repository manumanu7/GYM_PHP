
<?php
	session_start();
	$conn=mysqli_connect("localhost","root","","gym");	
	$error="";
	if(isset($_POST['User'])){
		$user=$_POST['User'];

		$sql="Select * from register where username='$user'";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$_SESSION["username"]=$user;
			header("Location:login1.php");
			$error="";
		}
		else{
			$error="1";
		}
	}

?>	

<html>
<head>
	<link rel="stylesheet" href="login.css">
</head>
<body>

	<div class="loginbox">
		<img src="images/avatar.jpg" class="avatar">
			<h1>Login Here</h1>
				<form action="login.php" method="post">
                    <br><br>
					<p>Username</P>
					<input type="text" placeholder="Enter User Name" required="required" name="User">

                    <br><br>

					<p style="color:red"><?php 
						if($error==="1"){
							echo "Username Not Exits";
						}
					?></p>
					
					<br><br>
					
					<input type="submit" value="Login">
					<a href="index.html" >Back</a><br>
					<a href="#" >Forgot Password?</a><br>
					<a href="register.php" >Don`t have account?</a>
				</form>
	</div>

</body>
</html>