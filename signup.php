<?php
$uname=$_POST['usn'];
$eid=$_POST['uem'];
$p=explode("@",$eid);
$peid=$p[1];
$pass=$_POST['pwd'];
$repass=$_POST['rpwd'];
$req=array('usn','uem','pwd','rpwd');
$er=0;
foreach($req as $fld)
{
	if(empty($_POST[$fld]))
	{
		$er=1;
	}
}
if($er==1)
{
	echo 'All fields are required<br><br>You will be redirected';
	header("Refresh:1; url=dtproj.php");
}
else
{

	if((strcasecmp($pass,$repass)==0)&&($peid=='gcet.edu.in'||'GCET.EDU.IN'))
	{
		$conn=new mysqli('localhost','root','','dt');
		if($conn->connect_error)
		{
			die("Connection Error :" .$conn->connect_error);
		}
		else
		{
				$q=mysqli_query($conn,"select * from register where name='$uname' or mid='$eid'");
				if(mysqli_num_rows($q)>0)
				{
					echo "User already exists<br><br>You will be redirected<br>";
					header("Refresh:1; url=dtproj.php");
				}
				else
				{
					$stmt=$conn->prepare("insert into register(name,mid,pass)values(?,?,?)");
					$stmt->bind_param("sss",$eid,$eid,$pass);
					$stmt->execute();
					echo "Registration Successfully done";
					echo "<br><br> Your id : ".$p[0];
					echo "<br><br><a href='dtproj.php'>click here to login!!</a>";
					$stmt->close();
					$conn->close();
				}
			}
		}
	else
		echo("Re-enter passwords correctly<br><br>Your mail id should be in @gcet.edu.in");
}
?>