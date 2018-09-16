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
    <title>Login</title>
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
                <li><a class="active" href="signup.php" style="float:right;">Sign up</a></li>
                <!-- <li><a href="#news">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li> -->
            </ul>
        </div>

    </header>
    <?php 
        require ("persistent/DBinfo.php");
        $db = connection();

        //echo ($db);
        if (isset($_POST['LoginSubmit'])){

            $uName = $_POST['uName'];
            $pass  = md5($_POST['pass']);

            $query =  "SELECT * FROM users WHERE UNAME='$uName' LIMIT 1";
            $output = mysqli_query($db,$query);
            while ($user = mysqli_fetch_array($output)) {

                if ($uName == $user['UNAME'] && $pass == $user['PASS'])
                {
                    echo "Welcome ".$user['FNAME'];
                    header("Location: index.php");
                    echo "
                    <script>
                        window.location.assign(\"index.php\")
                    </script>
                    ";
       
					$_SESSION["userName"] = $uName;
					$_SESSION["name"] = $user['FNAME']." ".$user['LNAME'];
					$_SESSION["userID"] = $user['ID'];
					$_SESSION["email"] = $user['EMAIL'];
					$_SESSION["editor"] = $user['EDITOR'];
					$_SESSION["nsuID"] = $user['NSU_ID'];
 
                    /* Make sure that code below does not get executed when we redirect. */
                    exit;

                }

                

                
                  
            }


        }
     ?>

    <div id = formbox class="extraHeight" align="center">


        <div id= "form">

            <h2> <br>Login to your account </h2>


            <div id= wrapper>

            <form id = "form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                
                <table>
                    
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" id="username" name="uName">
                        </td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" id="pass" name="pass">
                        </td>
                    </tr>
                    <tr>
                        <td><a href="/recovery"><small>Forgot password?</small></a></td>
                        <td><input class="btn" type="submit" name="LoginSubmit" value="Login" >
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