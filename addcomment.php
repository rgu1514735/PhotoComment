<?php

include("connection.php"); //Establishing connection with our database

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"]))
{

    $desc = stripslashes(trim($_POST["desc"]));
    $desc = mysql_real_escape_string($desc);
    $desc = htmlspecialchars($desc);

    $photoID = stripslashes(trim($_POST["photoID"]));
    $photoID = mysql_real_escape_string($photoID);

    $name = $_SESSION["username"];

    $sql="SELECT userID FROM users WHERE username='$name'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1) {
        //echo $name." ".$email." ".$password;
        $id = $row['userID'];
        $addsql = "INSERT INTO comments (description, postDate,photoID,userID) VALUES ('$desc',now(),'$photoID','$id')";
        $query = mysqli_query($db, $addsql) or die(mysqli_error($db));
        if ($query) {
            $msg = "Thank You! comment added. click <a href='photo.php?id=".$photoID."'>here</a> to go back";
        }
    }
    else{
        $msg = "You need to login first";
    }
}

?>