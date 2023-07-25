<!-- <html>

<head>
    <title>login page</title>
    <link rel="stylesheet" href="v.css">
    
    <style>

    </style>
</head>

<body>
    <div class="cursor"></div>
    <div class="box">
        <span class="borderline">
            <form method="post" enctype="multipart/form-data" >
                <h2>UPLOADING  A FILE</h2>
                <label>NAME :<input type="text" name="nae"><br>
                <label>RNO :</label><input type="text" name="roll"><br>
                <label>ADDRESS :</label><input type="text" name="adrs"><br>
                <div class="inputbox">
                    <input type="file" required="required" name="image">
                    <i></i>

                </div>
                
                
                <input type="submit" value="Upload" name="Upload" >
            </form>
        </span>
    </div>
    <script>
         
       const cursor= document.querySelector(".cursor");
        var timeout;
        document.addEventListener("mousemove",(e) =>{
            let x=e.pageX;
            let y=e.pageY;
            cursor.style.top =y +'px';
            cursor.style.left=x +'px';
            cursor.style.display='block';
             function mousestopped(){
                cusror.style.display='none';
             }
             clearTimeout(timeout);
                timeout=setTimeout(mousestopped,1000);
             
        });
    </script>
    
</body>

</html> -->

<!-- <!DOCTYPE html>
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
    <form  method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>Bus Pass Application</h2>
        <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" required name="nae">
            </div>
            <div class="form-group">
                <label for="rollNo">Roll No:</label>
                <input type="text" class="form-control" id="rollNo" placeholder="Enter your roll number" required name="roll">
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
                <input type="submit" class="btn btn-primary" name="Upload">
                <button type="submit" class="btn btn-primary">Submit</button> -->
            <!-- </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html> -->

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
	if(file_exists($uploads_dir))
	die('<font color="Crimson" size=5px >'.$pname.' File already Exists</font>');
    if($_FILES['image']['size']>5000000)
	die('<font color="yellow" size=5px>Choose a file size below 5MB</font>');
	$f1=explode(".",$pname);
	if(sizeof($f1)>2)
	{
		die('<font color="blue" size=5px>Multiple file extensions used</font>');
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
		die('<font color="#FF19F3" size=5px>'.$pname. ' is Wrong file format</font>');
	}
	if($x==0)
	{
	move_uploaded_file($tname, $uploads_dir);
	$sql = "INSERT INTO bpd(nae,rno,addr,fname,uploaded_on) values('$nae','$rols','$ad','$uploads_dir',now())";
    // $sql = "INSERT INTO bpd(nae,fname,uploaded_on) values('$nae','$uploads_dir',now())";
	if(mysqli_query($conn,$sql))
	die('<font color="green" size=5px> Your Application is Successfully Uploaded<br>Pay the required amount at the counter</font>');	
	}
}