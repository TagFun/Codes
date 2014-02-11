<?php

	session_start();

	// Yhdistetään tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");
	if (!$connect)
	{
		die("MySQL ei voida yhdistää!");
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
		die("Et antanut käyttäjätunnustasi (sahkopostiosoitetta)");
	}

	if($Sahkoposti_Check == false)
	{
		die("Kyseistä sähköpostia ei ole olemassa");
	}

	if($Nimi == "")
	{
		die("Et antanut nimeäsi");
	}

	// Tarkistetaan onko käyttäjätunnus jo olemassa
	$Query = mysql_query("SELECT * FROM kayttajat WHERE Sahkoposti = '$Sahkoposti' ");
	$Checkuser = mysql_num_rows($Query);
	if($Checkuser != 0)
	{ 
		echo "Käyttäjätunnus " .$Sahkoposti. " on jo käytössä." . "</br>";
	}

	$Salasana = 'a';

	// Tallennetaan tiedot tietokantaan
	if(!mysql_query("INSERT INTO kayttajat (Sahkoposti, Salasana, Nimi, Yritys, Ika)
	VALUES ('$Sahkoposti', '$Salasana', '$Nimi', '$Yritys', '$Ika')"))
	{
		die("Yritä uudestaan");
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
		$subject = 'Kiitos rekisteröinnistä!';
		$message = "Tervetuloa käyttäjäksemme! \n" . "Kayttajatunnus: $Sahkoposti \n" . "Salasana: " . $Salasana;
		$headers = 'From: rekisteroidy@tagfun.com' . "\r\n" .
    		'Reply-To: rekisteröityminen@tagfun.net' . "\r\n" .
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
		<p>Kiitos rekisteröinnistä! Salasana on lähetetty sähköpostiinne</p>
</body>
</html>