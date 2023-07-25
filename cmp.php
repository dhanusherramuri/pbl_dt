<?php
if(isset($_POST['submit']))
{
    $cl=$_POST["comp"];
    $opt=$_POST["cc"];
    $bs=$_POST["bno"];
    $con=new mysqli("localhost","root","","dt");
    if($con->connect_error)
    die ("Connection error :".$con->connect_error);
    else
    {
        // $sq="INSERT INTO cb(complaints,ct,Upoaded_on) values('$cl','$opt',now())";
        // die("Submitted Sucessfully");
        
        $s=$con->prepare("insert into cb(complaints,rt_no,ct,Uploaded_on) values(?,?,?,now())");
        $s->bind_param("sss",$cl,$bs,$opt);
        $s->execute();
        echo "Submitted sucessfully";
        $s->close();
        $con->close();
        header("refresh:2;url=index.php");
    }
}
else
die("SELECT OPTION<br>");
?>