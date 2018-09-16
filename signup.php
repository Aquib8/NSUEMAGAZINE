<?php
session_start();

    if($_SESSION){
        echo "You are already logged in!";
        header("Location: index.php");
        echo "
            <script>
                window.location.assign(\"index.php\")
            </script>
            ";
    }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<header>
		
		<div class="container">
			<a href="index.php" class="logo">
				<img src="logo.jpg" alt="NSU E-magazine" id="nylogo">
			</a>
		</div>
		<div class="navbar" style="float:right;">
            <ul id="navItems" style="float:right;">
                <li><a class="active" href="login.php" style="float:right;">Log in</a></li>
                <!-- <li><a href="#news">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li> -->
            </ul>
        </div>


	</header>






<!-- PHP code for submitting Form strts here  -->
 	<?php 
		require ("persistent/DBinfo.php");
		$nameErr = $emailErr = $genderErr = $websiteErr = "";
		$returnMsg="";
		$saved =0;


		$db = connection();
		$error =0;
	    $query =  "SELECT UNAME FROM users";
        $usernames = mysqli_query($db,$query); //list of usernames
		//echo ($db);
		if (isset($_POST['Submit'])){
			
			    $fName = ucfirst(strtolower($_POST['fName']));
			    	//echo $fName;
			  
		
			    $lName = ucfirst(strtolower($_POST['lName']));
			  

			if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			    $returnMsg = "Email is not a valid email address";
			    $error=$error+1;
			  }
			  else {
			    $email = strtolower($_POST['email']);
			    
			  }
			
			if (strlen($_POST["nsuID"])<7) {
			    $returnMsg = $returnMsg." NSU ID is not valid";
			    $error=$error+1;
			    } else {
			    $nsuID = $_POST['nsuID'];
			  }
			
			  	$temp = $_POST['uName'];
			  	while ($result = mysqli_fetch_array($usernames)) {
	            	
	            	$comp = strcasecmp($temp,$result['UNAME']);
	            	if ($comp==0){
	            		 $returnMsg =  $returnMsg." Username Already Exists.";
	            		$error=$error+1;
	            	}
	         	}

	          if (strlen($temp)<4 or strlen($temp)>15){
	          	$returnMsg =  $returnMsg." Username has to between 4 to 15 characters.";
	            $error=$error+1;
	          }

			  $uName = $_POST['uName'];
			  
			  $pass=$_POST["pass"];
			  $cPass=$_POST["cPass"];

			if ($pass!=$cPass) {
			  	$error=$error+1;
			     $returnMsg = $returnMsg." Passwords do not match.";
			  }
			  elseif (strlen($pass)<8) {
			  	$error=$error+1;
			    $returnMsg= $returnMsg." Password is less than 8 characters.";
			  }
			   else {
			    $pass  = md5($_POST["pass"]);
			  }

			
			$userType = $_POST['which'];
			$editor = 0;


			if ($error==0){
				$sql = "INSERT INTO users (FNAME,LNAME,EMAIL,NSU_ID,UNAME,PASS,USER,EDITOR)
			values ('$fName','$lName','$email','$nsuID','$uName','$pass','$userType','$editor')";
			
			mysqli_query ($db,$sql);
			 $returnMsg = "Dear ".$fName." ".$lName.", your account has been created. Love, NSU.";
			 $saved = 1;

			}
			else{

				$saved=-1;
			}
			
		}



	 ?>

<!-- PHP code for submitting Form ends here -->



	<div id = formbox  align="center">


		<div id= "form">

			<h2> <br>Create account </h2>

			<p>
				Already have an account?
				<a href="login.php">Log in</a>
			</p>

			<?php if($saved==1){?>
			<h3><?php echo $returnMsg; ?></h3>

			<script type="text/javascript">
				setTimeout(func, 4000);
				function func() {
					window.location.assign("login.php");
				}
			</script>
			<?php } if ($saved==-1){?>
				<h3><?php echo $returnMsg; ?></h3>
			<?php } ?>

			<div id= wrapper>

			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				
				<table>
					
					<tr>
						<td>First name</td>
						<td>
							<input type="text" id="fName" name="fName" required>
						</td>

					</tr>


					<tr>
						<td>Last name</td>
						<td>
							<input type="text" id="lName" name="lName" required>
						</td>
					</tr>

					<tr>
						<td>Email</td>
						<td>
							<input type="text" id="email" name="email" required>
						</td>
					</tr>
					<tr>
						<td>Username</td>
						<td>
							<input type="text" id="username" name="uName" title="Must have 4-15 characters" required>
						</td>
					</tr>

					<tr>
						<td>Password</td>
						<td>
							<input type="password" id="pass" name="pass" title="Must have at least 8 or more characters" required>
						</td>
					</tr>

					<tr>
						<td>Confirm password</td>
						<td>
							<input type="password" id="Cpass" name="cPass" required>
						</td>
					</tr>

					<tr>
						<td>NSU ID:</td>
						<td>
							<input type="text" id="Uid" name="nsuID" required>
						</td>
					</tr>

					<tr>
						<td>Be a :</td>
						<td>
							<form align ="left">
							<input type="radio" name="which" value="writer" checked> User<br>
		  					<input type="radio" name="which" value="editor">Editor<br>
		  					</form>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn" type="submit" name="Submit" value="Sign Up" >
						</td>
					</tr>

				</table>


			</form>
			</div>

		</div>

	</div>


	<footer align="center">
		<div class="copyright">
			<a href="www.google.com">© 2018 NSU E-magazine</a>
		</div>
		<div class="helpfulLinks">
			<ul>
				<li><a href="www.google.com">Help</a></li>
				<li><a href="www.google.com">Feedback</a></li>
			</ul>
		</div>
		<div class="socialLinks">
			<ul>
				<li><a href="www.facebook.com">Facebook</a></li>
				<li><a href="www.twitter.com">Twitter</a></li>
			</ul>
		</div>
		
	</footer>


</body>
</html>



