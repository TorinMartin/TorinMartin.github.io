<?php
session_start();

$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$recaptcha=$_POST['g-recaptcha-response'];
if(!empty($recaptcha))
{
include("getCurlData.php");
$google_url="https://www.google.com/recaptcha/api/siteverify";
$secret='6Lf5y-QUAAAAAIqbzNwyYEXB3bKV7RfybRtLOl-4';
$ip=$_SERVER['REMOTE_ADDR'];
$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
$res=getCurlData($url);
$res= json_decode($res, true);
//reCaptcha success check 
if($res['success'])
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$from = 'From: Torin Portfolio'; 
	$to = 'alowsedan@gmail.com'; 
	$subject = 'Run Ellie - Email Inquiry';
	if(isset($_POST['g-recaptcha-response']))
	$captcha=$_POST['g-recaptcha-response'];

	$body = "From: $name\n E-Mail: $email\n Message:\n $message";
	if (mail ($to, $subject, $body, $from)) { 
		echo '<center><p>Message sent successfully! </p><br /><br /><a href="index.html#contact">Back</a></center>';
	} else { 
		echo '<center><p>Oops! An error occurred. Try sending your message again.</p><br /><br /><a href="index.html#contact">Back</a></center>'; 
	}
}
else
{
$msg='<div class="center"><p>Captcha verification failed.</p><a href="index.html#contact"> Back</a></div>';
}

}
else
{
$msg='<div class="center"><p>Captcha verification failed.</p><a href="index.html#contact"> Back</a></div>';
}

}
?>
<link rel="stylesheet" type="text/css" href="styles.css" />