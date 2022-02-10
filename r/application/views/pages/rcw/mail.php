<?php
if(isset($_POST['s'])&&isset($_POST['to'])&&isset($_POST['m'])){
	$emailto = $_POST['to'];
	$emailfrom = 'bcsad@teachermaestro.com';
	$subject = $_POST['s'];
	$messagebody = $_POST['m'];
				
	$headers = "From: " . strip_tags($emailfrom) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($emailto) . "\r\n";
	$headers .= "CC: att_monitoring@gmail.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($emailto, $subject, $messagebody, $headers);
}
?>