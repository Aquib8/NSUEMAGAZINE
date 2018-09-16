<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>

		<?php



			// Check connection

			function connection()
			{
				$host = "localhost";
				$username = "root";
				$password = "";
				$database= "emagine";

				// Create connection
				$db = new mysqli($host, $username, $password,$database);
				return $db;
				 // if ($db)
				 // {
				 // 	echo "Connection successfull";
				 // }

				 // else
				 // {
				 // 	echo "Connection not successfull";
				 // } 
			}


		?>



	</body>
	</html>	

