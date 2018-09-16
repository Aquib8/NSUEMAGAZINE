<?php
    session_start();

    $username = $_SESSION['userName'];
    $name = $_SESSION['name'];
    $userID = $_SESSION["userID"];
    $nsuID = $_SESSION['nsuID'];

    if(!($nsuID > 1)){
        echo "1212";
        header("Location: login.php");
        echo "
            <script>
                window.location.assign(\"login.php\")
            </script>
            ";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>New post!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style type="text/css">

	
</style>
<body>

	<header>
        
        <div class="container">
            <a href="index.php" class="logo">
                <img src="logo.jpg" alt="NSU E-magazine" id="nylogo">
            </a>
        </div>
        <div class="navbar">
            <ul id="navItems">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="allArticles.php">Browse Articles</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

    </header>


<!-- PHP code for submitting ARTICLE starts here  -->
 	<?php 
		require ("persistent/DBinfo.php");
		$warning="";
		$x=0;
		$db = connection();

		if (isset($_POST['SubmitArticle'])){
			if (empty($_POST["heading"])) {
				$x=$x-1;
			} 
			else {
				$heading = $_POST['heading'];
			}
			
			if (empty($_POST["description"])) {
			    $x=$x-1;
			} 
			else {
			    $description = $_POST['description'];
			}
			$userID=$_SESSION["userID"];
			if ($x == 0 ){
				$sql = "INSERT INTO post (heading,description,user_id,user_name)
				values ('$heading','$description','$userID','$name')";	
				mysqli_query ($db,$sql);
				$warning = "Your article has been posted!";
			}
			else{
				$warning = "All fields are necessary!";
			}


		}

	 ?>

<!-- PHP code for submitting ARTICLE ends here -->

	<div id = formbox class="extraHeight" align="center">


		<div id= "form" >

			

			

			<div id= wrapper>

			<form action="" method="post" enctype="multipart/form-data">
				
				<table>
					<th></th>
					<th>
					<h2>Compose a new post:</h2> 
					<br>
					</th>
					
					<tr>
						<td>Heading</td>
						<td>
							<input type="text" id="heading" name="heading" required>
						</td>
					</tr>


					<tr>
						<td>Description</td>
						<td>
							<div class="descriptionBox">
								<textarea name="description" required></textarea>
							</div>
						</td>
					</tr>


					<tr>
						<td></td>
						<td><?php echo $warning ; ?></td>
					</tr>

					<tr>
						<td></td>
						<td><input class="btn" type="submit" name="SubmitArticle" value="Post" >
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
