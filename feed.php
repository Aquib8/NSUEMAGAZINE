<?php
    session_start();

   
    if(!$_SESSION){
        echo "Redirecting to login page...";
        
        echo "
                    <script>
                        window.location.assign(\"login.php\")
                    </script>
                    ";
    }
    //assigning session veriables to coder-friendly variables 
    $username = $_SESSION['userName'];
    $name = $_SESSION['name'];
    $nsuID = $_SESSION['nsuID'];
// retrieving passed varibles from url
	$pageID = $_GET['pageID'];
	$maxPostID = $_GET['lastMaxPostID'];
	//initiating the variable that will be passed to the next page as new max pst id
	$lastPrintedPostID=0;
	//increment of pageID for next page
	$pageID=$pageID+1;



?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="homedesign.css">
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
                <li><a class="active" href="newPost.php">Compose</a></li>
                <li><a href="allArticles.php">Browse Articles</a></li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
        </div>

    </header>



    <div id="container" style="min-height: 102em;">
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
        
<div id="feed">
    <!-- php code to fetch data starts here -->
	    <?php 
	        require ("persistent/DBinfo.php");
	        $query =  "SELECT * FROM post WHERE POST_ID<'$maxPostID' ORDER BY POST_ID DESC LIMIT 5";
	        $db=connection();
	        $output = mysqli_query($db,$query);
	        $count = 5;
	        while ($result = mysqli_fetch_array($output)) {
	             $heading = $result['HEADING'];
	             $description = $result['DESCRIPTION']; 
	             $post_id = $result['POST_ID']; 
	             $writer = $result['USER_NAME'];
	             $lastPrintedPostID=$post_id;

	             //echo "HEADING = ".$result['HEADING'];
	             //echo "DESCRIPTION = ".$result['DESCRIPTION'];
	             $count=$count-1; 
	    ?>

        
            <div id="trending">
            	<?php if (($count%2) == 0 ) { ?>

                <div id="trendingleft">
                    <img src="books.jpg" id="trendingimage">
                </div>

                <div id="trendingright">
                    <div id="rightpara">
				<?php } else {?>


                <div id="trendingright_1">
                    <img src="books.jpg" id="trendingimage">
                </div>

                <div id="trendingleft_1">
                    <div id="rightpara">
				<?php } ?>

                        
                    <h1> <?php echo $heading; ?> </h1>
  					<p> <?php echo $writer; ?> </p>
                    <p><?php echo $description; ?></p>
                    <br>
                    
                    
                    </div>
                    <div id="readMore">
                        <a href="post_detail.php?id=<?php echo $post_id;?>" id="readbutton1">Read article...</a>

                    </div>
                    
                </div>

            </div> <!-- First Post ends here-->

		

	    <?php

	        }
	    ?>

		<div id="trending" style="height:100%;margin-top: 20px;text-align:center">
			<div id="readMore" style="">
				<?php 
					if( $count!=0){
						echo "<a id=\"readbutton1\">No more posts to show.</a>";
					}
					else{
				 ?>
            	<a href="feed.php?pageID=<?php echo $pageID; ?>&lastMaxPostID=<?php echo $lastPrintedPostID; ?>" 
            	id="readbutton1">Read More Articles...</a>
            <?php } ?>
        	</div>
		</div>        
	</div>


</div>       

<footer align="center">
	<div id="footer">
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
    </div>
</footer>


</body>
</html>


