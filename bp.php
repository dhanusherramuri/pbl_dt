
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Pass Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
    background: url(view-interior-tram-frankfurt-germany.jpg);
    background-repeat: no-repeat;
    background-size: cover;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            background: transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        textarea.form-control {
            resize: none;
        }

        .custom-file-input~.custom-file-label::after {
            content: "Browse";
        }

        .submit-button {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body style="color: black;">
    <div class="container">
        <h2>Bus Pass Application</h2>
        <form  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="nae" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="rollNo">Roll No:</label>
                <input type="text" class="form-control" id="rollNo" name="roll" placeholder="Enter your roll number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" rows="4" placeholder="Enter your address" required name="adrs"></textarea>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileUpload" name="image">
                    <label class="custom-file-label" for="fileUpload">upload the image</label>
                </div>
            </div>
            <div class="submit-button">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php

$localhost = "localhost";
$dbus="root";
$dbpw="";
$dbname="dt";
$x=0;
$conn = mysqli_connect($localhost,$dbus,$dbpw,$dbname);
if (isset($_POST['submit']))
{
    $nae=$_POST['nae'];
    $rols=$_POST['roll'];
    $ad=$_POST['adrs'];
	$pname =$_FILES['image']['name'];
    $fileNameParts = explode('.', $pname);
    $ext = end($fileNameParts);
    $rename=$nae.".".$ext;
    $nn=$rename;
	$tname = $_FILES['image']['tmp_name'];
	$uploads_dir= "bpi/" .$nn;
	$t=date('d-m-y')."-".time();
	if(file_exists($uploads_dir))
	die('<font color="Crimson" size=5px align="center">'.$pname.' File already Exists</font>');
	if($_FILES['image']['size']>5000000)
	die('<font color="yellow" size=5px>Choose a file size below 5MB</font>');
	$f1=explode(".",$pname);
	if(sizeof($f1)>2)
	{
		die('<font color="blue" size=5px align="center">Multiple file extensions used</font>');
		echo "<br>";
	}
	$ok=array("jpg","jpeg","png");
	for($i=1;$i<sizeof($f1);$i++)
	{
	if(!in_array($f1[$i],$ok))
		$x=1;
	}
	if($x==1)
	{
		die('<font color="#FF19F3" size=5px align="center">'.$pname. ' is Wrong file format</font>');
	}
	if($x==0)
	{
	move_uploaded_file($tname, $uploads_dir);
	$sql = "INSERT INTO bpd(nae,rno,addr,fname,uploaded_on) values('$nae','$rols','$ad','$uploads_dir',now())";
    // $sql = "INSERT INTO bpd(nae,fname,uploaded_on) values('$nae','$uploads_dir',now())";
	if(mysqli_query($conn,$sql))
	die('<font color="green" size=5px align="center"> Your Application is Successfully Uploaded<br>Pay the required amount at the counter</font>');	
	}
}