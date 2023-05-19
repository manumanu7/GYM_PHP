<?php 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 


session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
<div class="loginbox">
			<h1>Login Here</h1>
            <p id="alert"></p>
				<form action="" method="post" id="x">
					<p>Gmail</P>
					<input type="email" placeholder="Enter Email..." required="required" name="email" >
                    <br>
					<input type="submit" value="Next" onfocusout="take()">
                    <br>
					<a href="login.php" >Back</a><br>
				</form>
                <script>
                    function take(){
                        document.getElementById("x").action="login.php";
                        document.getElementById("x").innerHTML="<p>OTP</P><input type='number' placeholder='Enter Email OTP...'' required='required' name='otp'> <br> <input type='submit' value='Submit'>";

                        <?php
                            if(isset($_POST['email'])){
                                $mail=$_POST['email'];

                                $otp=rand(1111,9999);

                                $sql="update otp set otp='$otp' where email='$email'";
                                $result=$conn->query($sql);

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
                                
                                $mail->addAddress($mail); 
                                
                                $mail->isHTML(true); 
                                
                                $mail->Subject = 'Email from Localhost by CodexWorld'; 
                                
                                $bodyContent = "<h1>Your OTP is : $otp</h1>";  
                                $mail->Body    = $bodyContent; 
                                
                                if(!$mail->send()) { 
                                    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
                                } else { 
                                    ?>
                                        document.getElementById("alert").innerHTML="OTP Has Sent to Your mail";
                                    <?php
                                }
                            }
                            

                            ?>


                    }
                </script>
				<?php
					unset($_SESSION['error']);
				?>
	</div>
</body>
</html>