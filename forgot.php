<?php

    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception; 


	session_start();
	$conn=mysqli_connect("localhost","root","","gym");	
	$error="";
	if(isset($_POST['email'])){
		$email=$_POST['email'];

		$sql="Select * from register where email='$email'";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$error="";
			setcookie("email",$email,time()+86400,"/");
            
            $otp=rand(1111,9999);

            require 'mailer/Exception.php'; 
            require 'mailer/PHPMailer.php'; 
            require 'mailer/SMTP.php'; 
            
            $mail = new PHPMailer; 

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';            
            $mail->SMTPAuth = true;
            $mail->Username = 'makmsm2@gmail.com';
            $mail->Password = 'ksfcstbfcdaylxyw';  
            $mail->SMTPSecure = 'ssl';            
            $mail->Port = 465; 
            
            $mail->setFrom('manugym@gmail.com', 'Manu\'s Gym'); 
            
            $mail->addAddress($email); 
            
            $mail->isHTML(true); 
            
            $mail->Subject = 'Reset Password'; 
            
            $bodyContent = "Your OTP is : '$otp'";
            $mail->Body    = $bodyContent; 
            $mail->send();

            $sql="update otp set otp='$otp' where email='$email'";
            $res=$conn->query($sql);

			header("Location:forgot1.php");
		}
		else{
			$error="1";
		}
	}

?>	

<html>
<head>
	<link rel="stylesheet" href="login.css">
    <style>
        .loginbox input[type="email"]{
            border:none;
            border-bottom:1px solid #fff;
            background:transparent;
            outline:none;
            height:40px;
            color:#fff;
            font-size:16px;
        }
    </style>
</head>
<body>

	<div class="loginbox">
		<img src="images/avatar.jpg" class="avatar">
			<h1>Forgot Password</h1>
				<form action="forgot.php" method="post">
                    <br><br>
					<p>Email</P>
					<input type="email" placeholder="Enter Email...." required="required" name="email">

                    <br><br>

					<p style="color:red"><?php 
						if($error==="1"){
							echo "Email Not Exits";
						}
					?></p>
					
					<br><br>
					
					<input type="submit" value="Login">
					<a href="index.html" >Back</a><br>
					<a href="register.php" >Don`t have account?</a>
				</form>
	</div>

</body>
</html>