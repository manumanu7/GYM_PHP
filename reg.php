<?php

    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception; 

    session_start();
    
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $dob=$_POST['dob'];
    $user=$_POST['user'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];




    $target_dir = "profiles/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "profiles/$user.".$imageFileType)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn=mysqli_connect("localhost","root","","memory");
    if(!$conn){
        die("connection failed");
    }

    $profile="profiles/$user." .$imageFileType;






    
    $conn=mysqli_connect("localhost","root","","gym");
    if(!$conn){
    	die("Connection failed");
	}

    $sql="select * from register where username='$user'";
    $result=$conn->query($sql);

    if($result->num_rows>0){
        $_SESSION['user']='1';
        header("Location:register.php");
    }

    $sql="select * from register where email='$email'";
    $result=$conn->query($sql);
    echo $result->num_rows;
    if($result->num_rows>0){
        $_SESSION['email']='1';
        header("Location:register.php");
    }

    $sql="select * from register where phone='$phone'";
    $result=$conn->query($sql);

    if($result->num_rows>0){
        $_SESSION['phone']='1';
        header("Location:register.php");
    }
    else{
        $sql="insert into register values('$fname','$lname','$dob','$user','$email','$phone','$password','$gender','$profile')";

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
            
            $mail->Subject = 'Registration For Manu Gym'; 
            
            $bodyContent = "<h1>Hello $fname $lname</h1>"; 
            $bodyContent .= '<h2>Welcome From Now Onwards You are a member in Manu`s Gym</h2>'; 
            $bodyContent .= '<p>Thank You <b>Manu\'s Gym</b></p>'; 
            $mail->Body    = $bodyContent; 
            $mail->send();
            header("Location:login.php");
        }
    }
?>