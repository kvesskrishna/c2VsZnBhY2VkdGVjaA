<?php
session_start();
require_once 'assets/PHPMailer/SMTPMailer.php';

if (isset($_POST['contactbtn'])) {
	$subject = "Selfpaced Tech - Message from contact form";
	$body = "Dear Admin, <br>"
	."There is a new subscription for Selfpaced tech news letter. Following are the details.<br>"
	."<br>Name: ".$_POST['name']
	."<br>Phone: ".$_POST['phone']
	."<br>Email address: ".$_POST['email']
	."<br>Message: ".$_POST['message']
	."<br><br><i>Webmaster,<br>Selfpaced Tech.</i>";
	SMTPMailer('training@selfpacedtech.com', $subject,$body);
	$_SESSION['success']=1;
	header('Location: '.$_SERVER['HTTP_REFERER']);	
}