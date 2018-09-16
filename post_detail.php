<?php
    session_start();

    $username = $_SESSION['userName'];
    $name = $_SESSION['name'];
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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="homedesign.css">
	<link rel="stylesheet" type="text/css" href="post_detail.css">
</head>
<body>

    <header>
        
        <div class="container">
            <a href="index.php" class="logo">
                <img src="logo.jpg" alt="NSU E-magazine" id="nylogo">
            </a>
        </div>
        <div class="navbar">
            <ul id="navItems">
                <li><a href="index.php">Home</a></li>
                <li><a href="newPost.php">Compose</a></li>
                <li><a href="allArticles.php">Browse Articles</a></li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
        </div>

    </header>


<?php 
	$id = $_GET['id'];
?>

    <div id="container_single">
        <div id="profileBar">

            <div id="profile">
                <img src="ball.jpg" id="profileImage">
                <br>
                <h1><?php echo $name; ?></h1>
                <p>@<?php echo $username; ?></p>
                <p><?php echo $nsuID; ?></p>
                <br>
                <a href="logout.php"><input class="btn" type="submit" name="LogoutSubmit" value="Logout" ></a>
            </div>
            
        </div>  <!-- ProfileBar Ends Here -->
        

    <!-- php code to fetch data starts here -->
	    <?php 
	        require ("persistent/DBinfo.php");
	        $query =  "SELECT * FROM post WHERE POST_ID=$id";
	        $db=connection();
	        $output = mysqli_query($db,$query);
	        while ($result = mysqli_fetch_array($output)) {
	              

	             //echo "HEADING = ".$result['HEADING'];
	             //echo "HEADING = ".$result['HEADING'];
	             $heading = $result['HEADING'];
	             $description = $result['DESCRIPTION'];
                 $writer = $result['USER_NAME'];
                 

	             
	             //echo "DESCRIPTION = ".$result['DESCRIPTION'];
	        }
	             
	    ?>

        <div id="feed">
            <div id="trending_single">
            	

                <div id="">
                    <img src="books.jpg" id="trendingimage">
                </div>

                

                <div id="">
                    
                    <div id="single_post_text">
                        
                    <h1 style="text-align: center;"> <?php echo $heading; ?> </h1>
                    <p style="text-align: center;"> <?php echo $writer; ?> </p>
  
                    <p ><?php echo $description; ?></p>
                    <br>
                    
                    
                </div>
            </div>
        </div>

                    
                

    </div> <!-- First Post ends here-->

		


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
    			