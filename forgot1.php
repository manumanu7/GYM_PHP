<?php
	session_start();
	$conn=mysqli_connect("localhost","root","","gym");	
	$error="";
	if(isset($_POST['otp'])){
		$otp=$_POST['otp'];
        $email=$_COOKIE['email'];
		$sql="Select * from otp where email='$email' and otp='$otp'";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			header("Location:reset.php");
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
			<h1>Forgot Password</h1>
            <br>
            <p style="font-weight:100;font-size:15px;color:red;">OTP had sent to your email please enter the OTP to reset your password</p>
				<form action="forgot1.php" method="post">
                    <br><br>
					<p>OTP</P>
					<input type="text" placeholder="Enter OTP...." required="required" name="otp">

                    <br>

					<p style="color:red"><?php 
						if($error==="1"){
							echo "Invalid OTP";
						}
					?></p>
					
					<br><br>
					
					<input type="submit" value="Login">
					<a href="index.html" >Back</a><br>
					
				</form>
	</div>

</body>
</html>