
<?php
	session_start();
	$message='';
	if(isset($_SESSION['user'])){
		$message="UserName Already Exits !!";
	}
	else if(isset($_SESSION['email'])){
		$message="Email Already Exits !!";
	}
	else if(isset($_SESSION['phone'])){
		$message="Phone Number Already Exits !!";
	}
?>


<html>
<head>
	<link rel="stylesheet" href="register.css">
	<style>
		#message {
			display:none;
			background: transparent;
			color: #fff;
			position: relative;
			padding: 20px;
			margin-top: 10px;
		}
		
		#message p {
			display:block;
			margin:15px;
			font-size: 18px;
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

	<div class="registerbox">
		<img src="images/avatar.jpg" class="avatar">
			<h1>Register Here</h1>
			<form action="reg.php" method="post" enctype="multipart/form-data">
			<div class="user">
				<div class="input-box">
					<span class="details">First Name</span>
					<input type="text" placeholder="Enter Frist Name" required="required" name="fname">
				</div>
				<div class="input-box">
					<span class="details">Last Name</span>
					<input type="text" placeholder="Enter Last Name" name="lname">
				</div>
				<div class="input-box">
					<span class="details">Date of Birth</span>
					<input type="date" placeholder="Enter Last Name" required="required" name="dob">
				</div>
				<div class="input-box">
					<span class="details">Username</span>
					<input type="text" placeholder="Enter Username" required="required" name="user">
				</div>
				<div class="input-box">
					<span class="details">Email</span>
					<input type="email" placeholder="Enter Email" required="required" name="email">
				</div>
				<div class="input-box">
					<span class="details">Phone Number</span>
					<input type="text" placeholder="Enter Phone Number" required="required" name="phone">
				</div>
				<div class="input-box">
					<span class="details">Password</span>
					<input type="password" placeholder="Enter Password" required="required" name="password" id="password" >
				</div>
				<div class="input-box">
					<span class="details">Conform Password</span>
					<input type="password" placeholder="Conform your password" required="required" name="conform" id="conform" onkeyup="check()" onblur="cp()">
				</div>
			</div>
			
			<div class="gender-details">
				<input type="radio" name="gender" value="m" id="dot-1" required>
				<input type="radio" name="gender" value="f" id="dot-2">
				<input type="radio" name="gender" value="o" id="dot-3">
					<span class="gender-title">Gender</span>
				<div class="category">
					<label for="dot-1">
						<span class="dot one"></span>
						<span class="gender">Male</span>
					</label>
					<label for="dot-2">
						<span class="dot two"></span>
						<span class="Female">Female</span>
					</label>
					<label for="dot-3">
						<span class="dot three"></span>
						<span class="Prefer not to say">Prefer not to say</span>
					</label>
				</div>
			</div>

			<div class="input-box">
				<span class="details">Profile Pic :</span><br><br>
				<input type="file" name="fileToUpload" id="fileToUpload" required="required">
				<span id="ch"></span>
			</div>
			
			<div id="message">
				<h3>Password must contain the following:</h3>
				<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number" class="invalid">A <b>number</b></p>
				<p id="length" class="invalid">Minimum <b>8 characters</b></p>
			</div>
			<h3 style="color:red" id="m"><?php echo $message; ?></h3>
			<div class="button">
				<input type="submit" value="Register" onclick="return check()">
			</div>
			<a href="login.php" >Already Have Account?</a>
			

			</form>

			<?php
				unset($_SESSION['user']);
				unset($_SESSION['phone']);
				unset($_SESSION['email']);
			?>
	</div>
	<script>

		var myInput = document.getElementById("password");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");
		let a=0,b=0,c=0,d=0;

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
</body>
</html>

