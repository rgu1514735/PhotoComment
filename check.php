<?php
        include('connection.php');
        session_start();
        $user_check=$_SESSION['username'];
        $expiretime = 2;
        $ses_sql = mysqli_query($db,"SELECT username, admin FROM users WHERE username='$user_check' ");
        $row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
        $login_user=$row['username'];

        if($row['admin']==1){
            $adminuser = true;
        }

        if(!isset($user_check))
        {
        header("Location: index.php");
        }
        if(isset($_SESSION['timeout']))
        {
            $checktime = time() - $_SESSION['timeout'];
            //echo $checktime;
           // $newexpiretime = $expiretime * 60;

            if($checktime >= 600)
            {
                session_unset();
                session_destroy();
                header("Location: index.php");
            }
            else
            {
                $_SESSION['timeout'] = time();
            }
        }
        else
        {
            $_SESSION['timeout'] = time();
        }
?>