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
    <link rel="stylesheet" type="text/css" href="allArticlesCss.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
        </div>

    </header>

    <table class="table">
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php 
            require ("persistent/DBinfo.php");
            $query =  "SELECT * FROM post ORDER BY POST_ID DESC";
            $db=connection();
            $output = mysqli_query($db,$query);
            $count = 5;
            while ($result = mysqli_fetch_array($output)) {
                 $heading = $result['HEADING'];
                 $description = $result['DESCRIPTION']; 
                 $post_id = $result['POST_ID']; 
                 // $writer = $result['USER_NAME'];

                 //echo "HEADING = ".$result['HEADING'];
                 //echo "DESCRIPTION = ".$result['DESCRIPTION']; 
        ?>

        <tr class="tablerow">
            <td>

            <div id="trending">

                <div id="trendingleft">
                    <img src="books.jpg" id="trendingimage">
                </div>

                <div id="trendingright">
                    <div id="rightpara">

                        
                    <h1> <?php echo $heading; ?> </h1>
                    <p> <?php echo "writer"; ?> </p>
  
                    <p><?php echo $description; ?></p>
                    <br>
                    
                    
                    </div>
                    <div id="readMore">
                        <a href="post_detail.php?id=<?php echo $post_id;?>" id="readbutton1">Read article...</a>

                    </div>
                    
                </div>

            </div>
            </td>
        </tr>

        <?php

            } // Loop ends here

        ?>
    </tbody>
    </table>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="tables/js/dataTables.bootstrap.min.js"></script>

<script>
    $(".table").DataTable({
        "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        "pageLength": 1,
        "paging": true,
        "serverSide": false,
        "processing": false
    });
</script>

</body>
</html>