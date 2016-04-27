<?php
	session_start();
	include("connection.php"); //Establishing connection with our database

	$error = ""; //Variable for storing our errors.
	$ip = $_SERVER['REMOTE_ADDR'];
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$error = "Both fields are required.";
		}else
		{
			// Define $username and $password
			$username= stripslashes($_POST['username']);
			$username = mysql_real_escape_string($username);


			$password=stripslashes($_POST['password']);
			$password = mysql_real_escape_string($password);
			$password = md5($password);


			
			//Check username and password from database




			$sql="SELECT userID FROM users WHERE username='$username' and password='$password'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC) ;
			
			//If username and password exist in our database then create a session.
			//Otherwise echo error.
			
			if(mysqli_num_rows($result) == 1)
			{
				$_SESSION['username'] = $username; // Initializing Session
				header("location: photos.php"); // Redirecting To Other Page
				$que1 = "UPDATE attempts SET attempt = '0' where ip = '$ip'";
				$res1 = mysqli_query($db,$que1);
			}else
			{
				$error = "Incorrect username or password.";
				$que = "SELECT attempt from attempts where ip = '$ip'";
				$res = mysqli_query($db,$que);
				$ro = mysqli_fetch_assoc($res);

				if(mysqli_num_rows($res) == 1)
				{
					//echo "update worked";
					$newattempt = $ro['attempt'];
					$newattempt = $newattempt +1;
					$time_of_attempt = time();
					$que1 = "UPDATE attempts SET attempt_time = '$time_of_attempt',attempt = '$newattempt' where ip = '$ip'";
					$res1 = mysqli_query($db,$que1);
				}
				else{

					$time_of_attempt = time();
					$que1 = "INSERT INTO attempts (ip,attempt_time,attempt) VALUES ('$ip','$time_of_attempt','0')";
					//echo $ip;
					if($res1 = mysqli_query($db,$que1))
					{
						//echo 'insert worked';
					}
					else
					{
						//echo 'insert did not worked';
					}
				}



			}

		}
	}

?>