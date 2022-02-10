<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if(isset($_POST['fromName'])&&isset($_POST['toName'])&&isset($_POST['toEmail'])&&isset($_POST['content'])){
	$mail = new PHPMailer;
	$mail->isSMTP(); 
	$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
	$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
	$mail->Port = 587; // TLS only
	$mail->SMTPSecure = 'tls'; // ssl is deprecated
	$mail->SMTPAuth = true;
	$mail->Username = 'mailingautomated@gmail.com'; // email
	$mail->Password = '3{t7<brbMpa?25~U'; // password
	$mail->setFrom('mailingautomated@gmail.com', $_POST['fromName'] . ' AUTO EMAILING SERVICE'); // From email and name
	$mail->addAddress($_POST['toEmail'], $_POST['toName']); // to email and name
	$mail->Subject = 'Do Not Reply - Automated Email';
	$mail->msgHTML($_POST['content']); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
	$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
	// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
	$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);
	if(!$mail->send()){
		echo "Mailer Error: " . $mail->ErrorInfo;
	}else{
		echo "Message sent!";
	}
}

?>