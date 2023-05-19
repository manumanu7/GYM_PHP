<?php
	session_start();
	$conn=mysqli_connect("localhost","root","","gym");
	$error="";

    $sql="select * from register where username='$_POST[User]' and password='$_POST[password]'";
	$result=$conn->query($sql);

	if($result->num_rows>0){
		$_SESSION['status']="true";
    	header("Location:loggedin.php");
    }
	else{
		$_SESSION['error']="1";
        header("Location:login1.php");
	}
?>