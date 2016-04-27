<?php
    include ('connection.php');

    $ip = $_SERVER['REMOTE_ADDR'];

    $que = "SELECT * from attempts where ip = '$ip'";
    $res = mysqli_query($db,$que);
    $ro = mysqli_fetch_assoc($res);
    if(mysqli_num_rows($res) == 1)
    {
        $num_attempt = $ro['attempt'];
        $attempt_time = $ro['attempt_time'];
        $block_time = 300;
        $attempt_time = time() - $attempt_time;
        if($num_attempt >= 3)
        {
            header('Location: Account_Locked.php');
            if($attempt_time < $block_time)
            {
                header('Location: Account_Locked.php');
            }
            else
            {
                $cmd ='';
                $error='';
            }
        }
        else{
            include('login.php');

            if ((isset($_SESSION['username']) != '')) {
                header('Location: photos.php');
            }
        }
    }
    else {
        include('login.php');

        if ((isset($_SESSION['username']) != '')) {
            header('Location: photos.php');
        }
    }

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP Login Form with Session</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
<div class="main">
<h1 style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif; font-size:32px;">Welcome to Photo Commenter</h1>
    <div class="formbox">
        <h3>Login Form</h3>
        <br><br>
        <form method="post" action="">
            <label>Username:</label><br>
            <input type="text" name="username" placeholder="username" id="username" "/><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" placeholder="password" id="password" />  <br><br>
            <input type="submit" name="submit" value="Login" />
        </form>
        <div class="error"><?php echo $error;?></div>
        <div class="register">You can register <a href="register.php"> here </a> </div>
    </div>

</div>
</body>
</html>