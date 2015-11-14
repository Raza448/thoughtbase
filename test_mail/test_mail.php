<?php
error_reporting(E_ALL);
$headers="MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";

$u_email = 'syed.wasi.abbas@gmail.com';
$f_name = 'test';
$f_number = 'sadsadsa';
$password = 'dsfdsfds';
// admin notify email
$admin_email = "syed.wasi.abbas@gmail.com";
$to =  $u_email;//$b_id;

$bodyOfMessage = "<b>Welcome to Traders Khazana!</b><br><br>Dear ".$f_name.",<br><br>Congratulations! You are one step closer to opening an account with traders khazana and trade at Rs. 20 per executed order, irrespective of quantity.<br>Never the less, you even enjoy an extra 10% of what we earn when you refer your friend and he also gets on board. Use our incisive technical research to amplify your trading skills.<br><br><b>Start filling online kyc application form by clicking the link below:</b><br><br><a style='text-decoration:none;color:#F16223;' href='http://".$_SERVER["HTTP_HOST"]."/app/login.php'>Start Application</a><br><br><br><b>Your online KYC application login details</b>:<br>Username: ".$u_email."<br>Password: ".$password."<br>Registered Mobile No.: ".$f_number."<br><br><b>Where to go from here?</b><br>Login with username and password to fill the online application and take a printout. If you don&#39;t have access to printer let us know we will send the forms to you.<br>After completion, attach the relevant docs &amp; send the forms to us or let us know we will get it picked. Give us 24 hours to open your account. In the mean time, we may ask you to face camera for in-person verification which is mandatory requirement by SEBI.<br><br>As you read this mail you might get a call from our customer executive to help you with your queries. Read our blog section which answers almost any question. Further queries can be written at info@traderskhazna.com or call us at +91-9696246246.<br><br>See you on board soon!<br><br>Team Traders Khazana<br/><br/><p style='color:#999'>This is an auto-generated email. Please do not reply back to this email.</p>";

if(!empty($u_email) && !empty($f_name) && !empty($f_number) && !empty($password)){
	require("class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsHTML(true); // if you are going to send HTML formatted emails
	$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
	$mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	$mail->Subject = "Thoughtbase";
	$mail->Body = $bodyOfMessage;
	$mail->AddAddress($u_email);
	$mail->AddBCC($admin_email);

	if(!$mail->Send()){
		echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;	
		// if not send mail using both services then notify admin
		$message = "Mail not sending using mandrill and gmail";
		$message .= "User Message: ". $bodyOfMessage;	
		// Send error notificaion to admin
		mail($admin_email, 'Email sending failed error notice' . date("Y-m-d H:i:s") , $message, $headers);		
	}else{
		echo "1";
	}
}?>