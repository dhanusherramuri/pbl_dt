<?php
session_start();
$uname=$_POST['logemail'];
$pwd=$_POST['logpass'];
if(empty($uname))
{
    echo "Name is required";
    header("Refresh:1; url=dtproj.php");
    exit();
}
elseif(empty($pwd))
{
    echo "Password is required";
    header("Refresh:1; url=dtproj.php");
    exit();
}
$conn=new mysqli('localhost','root','','dt');
if($conn->connect_error)
{
    die("Connection Error :" .$conn->connect_error);
}
else
{
        $q=mysqli_query($conn,"select * from register where mid='$uname' AND pass='$pwd'");
        if(mysqli_num_rows($q)===1)
        {
            $r=mysqli_fetch_row($q);
                echo "logged in<br><br>You will be redirected in 3 sec";
                $um=$r[0];
                $_SESSION['val']=$uname;
                $valid=$_SESSION['val'];
                $_SESSION['usnm']=$um;
                $un=$_SESSION['usnm'];
                header("Refresh:3; url=index.php");
        }
        else
        {
            echo "Wrong username or Password";
header("Refresh:1; url=dtproj.html");
exit();
        }
        // else
        // echo "INVALID CREDENTIALS";
    }
?>