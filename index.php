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
    $username = $_SESSION['userName'];
    $name = $_SESSION['name'];
    $nsuID = $_SESSION['nsuID'];
    $email=$_SESSION["email"];

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
                <li><a class="active" href="newPost.php">Compose</a></li>
                <li><a href="allArticles.php">Browse Articles</a></li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
        </div>

    </header>



    <div id="container" style="min-height: 64em;">
        <div id="profileBar">

            <div id="profile">
                <img src="ball.jpg" id="profileImage">
                <br>
                <h1><?php echo $name; ?></h1>

                <p>@<?php echo $username; ?></p>
                <br>
                <!-- <p><?php echo $email; ?></p> -->
                <p><?php echo $nsuID; ?></p>
                <br>
                <a href="logout.php"><input class="btn" type="submit" name="LogoutSubmit" value="Logout" ></a>
            </div>
            
        </div>  <!-- ProfileBar Ends Here -->
        
<div id="feed">
    <!-- php code to fetch data starts here -->
	    <?php 
	        require ("persistent/DBinfo.php");
	        $query =  "SELECT * FROM post ORDER BY POST_ID DESC LIMIT 3";
	        $db=connection();
	        $output = mysqli_query($db,$query);
	        $count = 3;
	        while ($result = mysqli_fetch_array($output)) {
	             $heading = $result['HEADING'];
	             $writer = $result['USER_NAME'];
	             $description = $result['DESCRIPTION']; 
	             $post_id = $result['POST_ID']; 

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

            </div> 
		

	    <?php

	        } // Loop ends here

	    ?>

		<div id="trending" style="height:100%;margin-top: 20px;text-align:center">
			<div id="readMore" style="">
            	<a href="feed.php?pageID=1&lastMaxPostID=99999999" id="readbutton1">Show All Articles...</a>
        	</div>
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


<!--         
            <div id="newly-added">

                <div id="newleft">

                    <div id="leftpara">
                        
                    <h1>Topic 1</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <br>
                    <a href="www.facebook.com" id="readbutton2">Read article...</a>

                    </div>
                </div>

                <div id="newright">
                    
                    <img src="ball.jpg" id="newimage">
                    
                </div>

            </div> // Second Post ends here
            
        </div>    //Feed ends here

    </div>// First Container ends here 




    <div id="listview">
    		 	<a href="#">
    			<div id="first">
    				<img src="ball.jpg" id="firstimage">
    				<br>
    				<h1>Topic 1</h1>
    				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    				consequat.</p>
    			</div></a>

    			<a href="#">
    			<div id="second">
    				<img src="books.jpg" id="secondimage">
    				<br>
    				<h1>Topic 1</h1>
    				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    				consequat.</p>
    			</div></a>

    			<a href="#">
    			<div id="third">
    				<img src="books.jpg" id="thirdimage">
    				<br>
    				<h1>Topic 1</h1>
    				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    				consequat.</p>
    			</div></a>

    			<a href="#">
    			<div id="fourth">
    				<img src="ball.jpg" id="fourthimage">
    				<br>
    				<h1>Topic 1</h1>
    				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    				consequat.</p>
    			</div></a>

    </div>
 -->