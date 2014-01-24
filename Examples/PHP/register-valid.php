<?php

/*
 * @author Nina Ranta | TagFun
 */

	session_start();

	// Yhdistetään tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");
	if (!$connect)
	{
		die("MySQL ei voida yhdistää!");
	}

	$DB = mysql_select_db('jmdproje_kyselyjarjestelma');

	if(!$DB)
	{
		die("Virhe tietokantaa valittaessa!");
	}

	// Haetaan annetut tiedot lomakkeelta
	$Sahkoposti = $_GET["sahkoposti"];
	$Sahkoposti1 = "@";
	$Sahkoposti_Check = strpos($Sahkoposti,$Sahkoposti1);
	$Etunimi = $_GET["etunimi"];
	$Sukunimi = $_GET["sukunimi"];
	$Yritys = $_GET["yritys"];
	$Ika = $_GET["ika"];
	$Sukupuoli = $_GET["sukupuoli"];

	// Muutetaan sukupuolitieto kirjoitettavaan muotoon
	if($Sukupuoli == 'n')
	{
		$k_spuoli = "Nainen";
	}

	else
	{
		$k_spuoli = "Mies";
	}
	
	// Tarkistetaan annetut tiedot
	if($Sahkoposti == "")
	{
		die("Et antanut käyttäjätunnustasi (sahkopostiosoitetta)");
	}

	if($Sahkoposti_Check == false)
	{
		die("Kyseistä sähköpostia ei ole olemassa");
	}

	if($Etunimi == "")
	{
		die("Et antanut etunimeäsi");
	}

	if($Sukunimi == "")
	{
		die("Et antanut sukunimeäsi");
	}

	if($Ika == "")
	{
		die("Et antanut ikääsi");
	}

	if($Sukupuoli == "")
	{
		die("Et antanut sukupuoltasi");
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
	if(!mysql_query("INSERT INTO kayttajat (Sahkoposti, Salasana, Etunimi, Sukunimi, Yritys, Ika, Sukupuoli)
	VALUES ('$Sahkoposti', '$Salasana', '$Etunimi', '$Sukunimi', '$Yritys', '$Ika', '$Sukupuoli')"))
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
		$headers = 'From: SplitSurvey@example.com' . "\r\n" .
    		'Reply-To: SplitSurvey@example.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	

	
	}

?>