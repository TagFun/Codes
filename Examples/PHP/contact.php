<?php

/*
 * @author Nina Ranta | TagFun
 */


	session_start();

	//if(isset($_POST['sahkoposti'])) 
	//{
   		$email_to = "nina.ranta@hotmail.com";
    		$email_subject = "Nina Ranta | TagFun";
	
		function died($error) 
		{
	        	// Error
       	 	echo "error!";
        		die();
    		}
     
    		// validation expected data exists
    		if(!isset($_GET['etunimi']) ||
        	!isset($_GET['sukunimi']) ||
        	!isset($_GET['sahkoposti']) ||
        	!isset($_GET['kommentti'])) 
		{
        		died('error.');      
    		}
     
    		$Etunimi = $_GET['etunimi']; // required
    		$Sukunimi = $_GET['sukunimi']; // required
    		$Sahkoposti = $_GET['sahkoposti']; // required
    		$Kommentti = $_GET['kommentti']; // not required
       
    		$error_message = "";
    		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  		if(!preg_match($email_exp,$Sahkoposti)) 
		{
    			$error_message .= 'Sähköposti virheellinen.<br />';
  		}
    
		$string_exp = "/^[A-Za-z .'-]+$/";
  		if(!preg_match($string_exp,$Etunimi)) 
		{
    			$error_message .= 'Etunimi virheellinen.<br />';
  		}
  
		if(!preg_match($string_exp,$Sukunimi)) 
		{
    			$error_message .= 'Sukunimi virheellinen.<br />';
  		}
  
		if(strlen($Kommentti) < 2) 
		{
    			$error_message .= 'Viesti virheellinen.<br />';
  		}
  
		if(strlen($error_message) > 0) 
		{
    			died($error_message);
  		}
    		
		$email_message = "Tiedot löydettävissä ylhäältä.\n\n";
     
    		function clean_string($string) 
		{
      			$bad = array("content-type","bcc:","to:","cc:","href");
      			return str_replace($bad,"",$string);
    		}
     
    		$email_message .= "Etunimi: ".clean_string($Etunimi)."\n";
    		$email_message .= "Sukunimi: ".clean_string($Sukunimi)."\n";
    		$email_message .= "Sahkoposti: ".clean_string($Sahkoposti)."\n";
    		$email_message .= "Kommentti: ".clean_string($Kommentti)."\n";   
     
		// create email headers
		$headers = 'Lähettäjä: ' . $Sahkoposti . "\r\n" . 'Reply-To: '.$Sahkoposti . "\r\n";
		@mail($email_to, $email_subject, $email_message, $headers); 

	//}
?>
