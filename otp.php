<?php
if(isset($_POST['log']))
{
	// Account details
	$apiKey = urlencode('NGE1NTM0NDc1NzY2NDc1NjZjNTk0OTY0NzE0NTYyNDU=');
	
	// Message details
	$numbers = "91".$_POST['num'];
	$sender = urlencode('GCET');
	$message = rawurlencode('This is your message');
 
	// $numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo "SUCESSFULLY SENT";
}
if(isset($_POST['verify']))
{
	$verotp=$_POST['ver'];
	if($verotp==$_COOKIE['otp'])
		echo "Login successful";
	else
		echo "Wrong otp";
}
?>
<html>
<body>
<form method="post" action="otp.php">
Number : <input type="text" name="num" placeholder="with valid country code"><br>
<input type="submit" name="log">
<div>
Verify Otp:<br>
<input type="text" name="ver" placeholder="Enter OTP"><br>
<input type="submit" name="verify" value="verify OTP"></div>
</form>
</body>
</html>