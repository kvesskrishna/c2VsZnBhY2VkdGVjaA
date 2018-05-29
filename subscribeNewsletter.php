<?php
require_once 'assets/PHPMailer/SMTPMailer.php';
// SMTPMailer('krishna.kkarthi@gmail.com','Test Mail','Test body');
if (isset($_POST['subscribe'])) {
	$subject = 'Selfpaced Tech Newsletter Subscription activated';
	$body = "Dear Admin, <br>"
	."There is a new subscription for Selfpaced tech news letter. Following are the details.<br>"
	."Email address: ".$_POST['email']
	."<br>Webmaster,<br>Selfpaced Tech.";
	SMTPMailer('training@selfpacedtech.com', $subject,$body);
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
