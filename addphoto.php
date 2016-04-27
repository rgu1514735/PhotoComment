<?php

include("connection.php"); //Establishing connection with our database
//include("check.php");

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"])) {
    //sanitizing input
    $title = stripslashes(trim($_POST["title"]));
    $title = mysql_real_escape_string($title);
    $title = htmlspecialchars($title);

    //sanitizing input
    $desc = stripslashes(trim($_POST["desc"]));
    $desc = mysql_real_escape_string($desc);
    $desc = htmlspecialchars($desc);

    $url = "test";
    $name = $_SESSION["username"];




    $filname = $_FILES['fileToUpload']['name'];
    $file_ext = substr($filname, strrpos($filname, '.') + 1);
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];

    $target_dir = "unknown_files/";
    $target_file = $target_dir .  md5(uniqid() .basename($_FILES["fileToUpload"]["name"]).$file_ext);
    $uploadOk = 1;

    if ((strtolower($file_ext) == 'jpg' || strtolower($file_ext) == 'jpeg' || strtolower($file_ext) == 'png') &&
        ($file_size < 100000) &&
        ($file_type == 'image/jpeg' || $file_type == 'image/png') &&
        getimagesize($file_tmp) ) {

        $sql = "SELECT userID FROM users WHERE username='$name'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) == 1) {

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $id = $row['userID'];
                $addsql = "INSERT INTO photos (title, description, postDate, url, userID) VALUES ('$title','$desc',now(),'$target_file','$id')";
                $query = mysqli_query($db, $addsql) or die(mysqli_error($db));
                    if ($query) {
                        $msg = "Thank You! The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. click <a href='photos.php'>here</a> to go back";
                    }

            }else {
                $msg = "Sorry, there was an error uploading your file.";
            }
            //echo $name." ".$email." ".$password;


        } else {
            $msg = "You need to login first";
        }
    }
    else
    {
        $msg = 'invalid file type';
    }


}

?>