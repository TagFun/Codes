<?php

	session_start();

	// Yhdistet��n tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");
	if (!$connect)
	{
		die("MySQL ei voida yhdist��!");
	}

	$DB = mysql_select_db('jmdproje_profile');

	if(!$DB)
	{
		die("Virhe tietokantaa valittaessa!");
	}

	// Haetaan annetut tiedot lomakkeelta
	$Sahkoposti = $_GET["sahkoposti"];
	$Sahkoposti1 = "@";
	$Sahkoposti_Check = strpos($Sahkoposti,$Sahkoposti1);
	$Nimi = $_GET["nimi"];
	$Yritys = $_GET["yritys"];
	$Ika = $_GET["ika"];

	// Tarkistetaan annetut tiedot
	if($Sahkoposti == "")
	{
		die("Et antanut k�ytt�j�tunnustasi (sahkopostiosoitetta)");
	}

	if($Sahkoposti_Check == false)
	{
		die("Kyseist� s�hk�postia ei ole olemassa");
	}

	if($Nimi == "")
	{
		die("Et antanut nime�si");
	}

	// Tarkistetaan onko k�ytt�j�tunnus jo olemassa
	$Query = mysql_query("SELECT * FROM kayttajat WHERE Sahkoposti = '$Sahkoposti' ");
	$Checkuser = mysql_num_rows($Query);
	if($Checkuser != 0)
	{ 
		echo "K�ytt�j�tunnus " .$Sahkoposti. " on jo k�yt�ss�." . "</br>";
	}

	$Salasana = 'a';

	// Tallennetaan tiedot tietokantaan
	if(!mysql_query("INSERT INTO kayttajat (Sahkoposti, Salasana, Nimi, Yritys, Ika)
	VALUES ('$Sahkoposti', '$Salasana', '$Nimi', '$Yritys', '$Ika')"))
	{
		die("Yrit� uudestaan");
	}

	else
	{	

		function randomPassword() 
		{
  			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    		 	$pass = array();
    		 	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    		 	for ($i = 0; $i < 8; $i++)
		  	{
       			 $n = rand(0, $alphaLength);
       			 $pass[] = $alphabet[$n];
		   	}
	    		return implode($pass);
		}	
	
		$Salasana = randomPassword();

		// Kryptataan salasana 
		$Encrypt_salasana = md5($Salasana);
	
		mysql_query("UPDATE kayttajat SET Salasana ='$Encrypt_salasana' WHERE Sahkoposti='$Sahkoposti'");

		$to      = $Sahkoposti;
		$subject = 'Kiitos rekister�innist�!';
		$message = "Tervetuloa k�ytt�j�ksemme! \n" . "Kayttajatunnus: $Sahkoposti \n" . "Salasana: " . $Salasana;
		$headers = 'From: rekisteroidy@tagfun.com' . "\r\n" .
    		'Reply-To: rekister�ityminen@tagfun.net' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	

	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>TagFun | Nina Ranta</title>
</head>
<body>
		<style type="text/css">
		p {text-align: center; color: white;}
		</style>
		<p>Kiitos rekister�innist�! Salasana on l�hetetty s�hk�postiinne</p>
</body>
</html>