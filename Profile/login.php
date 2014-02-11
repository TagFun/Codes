<?php

	session_start();
	if(isset($_SESSION['sahkoposti']))
	{
		header('Location: profile.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>TagFun Profile | Login</title>
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
<body>
  <div class="wrapper"> 
    <div id="contact_form">
    <form name="form1" id="ff" method="post" action="login_valid.php">
    <h1>Kirjaudu sisään</h1> 
        <label>
        <span>Email*:</span>
        <input type="email" placeholder="Syötä sähköpostisi" name="sahkoposti" id="sahkoposti" required autofocus>
        </label>
         
        <label>
        <span>Salasana*:</span>   
        <input type="text" placeholder="Syötä salasanasi" name="salasana" id="salasana" required>
        </label>
       
        <input class="sendButton" type="submit" name="Submit" value="Kirjaudu">
             
    </form>
    </div>
   </div>
 
</body>
</html>