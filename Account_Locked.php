<?php
include ('connection.php');

$ip = $_SERVER['REMOTE_ADDR'];

$que = "SELECT * from attempts where ip = '$ip'";
$res = mysqli_query($db,$que);
$ro = mysqli_fetch_assoc($res);
$time_left ='';
if(mysqli_num_rows($res) == 1) {

    $attempt_time = $ro['attempt_time'];
    $block_time = 300;
    $attempt_time = time() - $attempt_time;
  // echo $attempt_time;
   $time_left = round($attempt_time /60);
    //echo $time_left;
   // $time_left = substr($time_left,1,2);
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Login Form with Session</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript">
        window.setTimeout(function(){ document.location.reload(true); }, 15000);
    </script>
</head>

<body>
<div class="main">

    <?php
            if($attempt_time>300 ) {

               echo '<h1> You can Login now </h1><br/>';
            $que1 = "UPDATE attempts SET attempt = '0' where ip = '$ip'";
            $res1 = mysqli_query($db,$que1);
            echo '<a href="index.php"> Return to Homepage</a> ';
        }
        else
        {
           $time_left =  5 - $time_left;
            //echo $time_left;
           echo '<h1> You have exceed the login limit and  will be unblocked in ';
               echo $time_left;
            echo ' Minutes</h1><br/>';
            echo '<button disabled="disabled"><a href="index.php"> Return to Homepage</a> </button>';
        }

    ?>

</div>
</body>
</html>