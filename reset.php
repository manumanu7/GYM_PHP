<?php

    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception; 

	session_start();
	$conn=mysqli_connect("localhost","root","","gym");	
	$error="";
	if(isset($_POST['conform'])){
		$password=$_POST['password'];
        $email=$_COOKIE['email'];
		$sql="update register set password='$password' where email='$email'";
		if($conn->query($sql)){

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
            
            $bodyContent = "Your Password has been reset";
            $mail->Body    = $bodyContent; 
            $mail->send();

			header("Location:login.php");
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
    <style>
        .loginbox{
            height:auto;
        }
		#message {
			display:none;
			background: transparent;
			color: #fff;
			position: relative;
			padding: 5px;
			margin-top: 5px;
		}
		
		#message p {
			display:block;
			margin:5px;
            margin-bottom:10px;
			font-size: 13px;
		}

		.valid {
			color: green;
		}
		
		.valid:before {
			position: relative;
			left: -35px;
		}
		
		.invalid {
			color: red;
		}
		
		.invalid:before {
			position: relative;
			left: -35px;
		}
	</style>
</head>
<body>

	<div class="loginbox">
		<img src="images/avatar.jpg" class="avatar">
			<h1>Reset Password</h1>
            <br>
				<form action="reset.php" method="post">
                    <br>
					<p>Password</P>
					<input type="password" placeholder="Enter Password" required="required" name="password" id="password">
					<p>Conform Password</P>
					<input type="password" placeholder="Conform your Password" required="required" name="conform" id="conform" onkeyup="check()" onblur="cp()"  >

					<p style="color:red" id="m"></p>
					
                    <div id="message">
                        <h3>Password must contain the following:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
					
					<input type="submit" value="Login">
					<a href="login.html" >Back</a><br>
					
				</form>
                <script>
                    var myInput = document.getElementById("password");
                    var letter = document.getElementById("letter");
                    var capital = document.getElementById("capital");
                    var number = document.getElementById("number");
                    var length = document.getElementById("length");
                    
                    myInput.onfocus = function() {
                        document.getElementById("message").style.display = "block";
                    }

                    myInput.onblur = function() {
                        document.getElementById("message").style.display = "none";
                        if(a!=0 || b!=0 || c!=0 || d!=0){
                            myInput.value="";
                        }
                    }

                    myInput.onkeyup = function() {
                        // Validate lowercase letters
                        var lowerCaseLetters = /[a-z]/g;
                        if(myInput.value.match(lowerCaseLetters)) {  
                            letter.classList.remove("invalid");
                            letter.classList.add("valid");
                            a=0;
                        } else {
                            letter.classList.remove("valid");
                            letter.classList.add("invalid");
                            a=1;
                        }
                        
                        // Validate capital letters
                        var upperCaseLetters = /[A-Z]/g;
                        if(myInput.value.match(upperCaseLetters)) {  
                            capital.classList.remove("invalid");
                            capital.classList.add("valid");
                            b=0;
                        } else {
                            capital.classList.remove("valid");
                            capital.classList.add("invalid");
                            b=1;
                        }

                        // Validate numbers
                        var numbers = /[0-9]/g;
                        if(myInput.value.match(numbers)) {  
                            number.classList.remove("invalid");
                            number.classList.add("valid");
                            c=0;
                        } else {
                            number.classList.remove("valid");
                            number.classList.add("invalid");
                            c=1;
                        }
                        
                        // Validate length
                        if(myInput.value.length >= 8) {
                            length.classList.remove("invalid");
                            length.classList.add("valid");
                            d=0;
                        } else {
                            length.classList.remove("valid");
                            length.classList.add("invalid");
                            d=1;
                        }
                    }

                    let y=0;
                    function check(){
                        let pass=document.getElementById("password").value;
                        let con=document.getElementById("conform").value;
                        if(pass!==con){
                            document.getElementById("m").innerHTML="Password Doesnot Match";
                            y=1;
                        }
                        else{
                            document.getElementById("m").innerHTML="";
                            y=0;
                        }
                    }
                    function cp(){
                        if(y!=0){
                            document.getElementById("conform").value="";
                            document.getElementById("m").innerHTML="";
                        }

                    }
                </script>
	</div>

</body>
</html>