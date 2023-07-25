<html>
<body>
	<form method="post">
		<input type="submit" name="submit">
</form>
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","","dt");
if (isset($_POST['submit']))
{
	$r=mysqli_query($conn,"select * from events");
    while($x=mysqli_fetch_row($r))
               echo('<font color="green" size=5px>'.$x[0].'<br><br></font>');	
    mysqli_free_result($r);
	}