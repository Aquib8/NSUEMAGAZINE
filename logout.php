<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
   
</head>
<body>


    <?php
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy();
		header("Location: login.php");
		echo "
            <script>
                window.location.assign(\"login.php\")
            </script>
            ";
    ?>

    <h1>You have been logged out.</h1>


	
</body>
