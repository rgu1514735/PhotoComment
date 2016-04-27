<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $name = stripslashes($_POST["username"]);
    $name = mysql_real_escape_string($name);

    $email = stripslashes($_POST["email"]);
    $email = mysql_real_escape_string($email);

    $password = stripslashes($_POST["password"]);
    $password = mysql_real_escape_string($password);
    $password = md5($password);



    $sql="SELECT email FROM users WHERE email='$email'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1)
    {
        $msg = "Sorry...This email already exists...";
    }
    else
    {
        //echo $name." ".$email." ".$password;
        $query = mysqli_query($db, "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')")or die(mysqli_error($db));
        if($query)
        {
            $msg = "Thank You! you are now registered. click <a href='index.php'>here</a> to login";
        }

    }
}
?>