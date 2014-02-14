<?php

	// Get values from the form
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$message=$_POST['message'];
 
	$to = "nina.ranta@hotmail.com";
	$subject = "You have got a message";
	$message = " Name: " . $name . "\r\n Email: " . $email . "\r\n Phone: " . $phone . "\r\n Message: " . $message;
 
 
	$from = $_POST['name'];
	$headers = "From:" . $from . "\r\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1" . "\r\n";
 
	if(@mail($to,$subject,$message,$headers))
	{
 	 	header('Location: contacted.html');
	}

?>