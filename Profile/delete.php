<?php

	session_start();
	if(!isset($_SESSION['sahkoposti']))
	{
		die("Kirjaudu sisään");
	}

	$Sahkoposti = $_SESSION['sahkoposti'];

	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");

	if (!$connect)
  	{
  		die('ei voitu yhdistää: ' . mysql_error());
  	}

	$DB = mysql_select_db('jmdproje_profile');

	mysql_query("DELETE FROM kayttajat WHERE Sahkoposti = '$Sahkoposti'");

	mysql_close($connect);

?> 

<html>
<body>
<br>
<a href="http://www.jmdprojects.net/blog-tagfun">etusivulle</a>
</body>
</html>