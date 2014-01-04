<?php

//---------------------------- CONNECTING TO DATABASE--------------------------------

	session_start();

	

	// Yhdistäminen tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","NINNI123");

	if (!$connect)
	{
		die("MySQL ei voitu yhdistää!");
	}

	$DB = mysql_select_db('jmdproje_tagfun');

	if(!$DB)
	{
		die("MySQL ei voinut yhdistää tietokantaan");
	}

	// Muuttujien määrittely
	$Sahkoposti = $_GET['sahkoposti'];
	$Salasana = $_GET['salasana'];
	
	// Kryptataan salasana
	// Tämän jälkeen käytetään koko ajan $Encrypt_salasana
	$Encrypt_salasana = md5($Salasana);

	$Query = mysql_query("SELECT * FROM kayttajat WHERE Sahkoposti ='$Sahkoposti' AND Salasana = '$Encrypt_salasana'");
	$NumRows = mysql_num_rows($Query);
	$_SESSION['sahkoposti'] = $Sahkoposti;
	$_SESSION['encrypt_salasana'] = $Encrypt_salasana;

	// Tarkistetaan onko käyttäjä syöttänyt kaikki tarvittavat tiedot
	if(empty($_SESSION['sahkoposti']) || empty($_SESSION['encrypt_salasana']))
	{
		// Lopetetaan sessio jos syöttää tyhjät tiedot
		unset($_SESSION['sahkoposti']); 
		die("Palaa takaisin ja rekisteröidy päästäksesi sivustolle");
		//session_destroy();
	}

	if($Sahkoposti == "" && $Encrypt_salasana == "")
	{
		unset($_SESSION['sahkoposti']);
		die("Anna käyttäjätunnus ja salasana!");
		//session_destroy();
	}

	if($Sahkoposti == "")
	{
		unset($_SESSION['sahkoposti']);
		die("Anna käyttäjätunnus!" . "</br>");
		//session_destroy();
	}

	if($Encrypt_salasana == "")
	{
		unset($_SESSION['sahkoposti']); 
		die("Anna salasana!");
		echo "</br>";
		//session_destroy();
	}

	// Käyttäjätunnuksen ja salasanan tarkistaminen tietokannasta

	if($NumRows != 0)
	{
		while($Row = mysql_fetch_assoc($Query))
		{
			$Database_Sahkoposti = $Row['sahkoposti'];
			$Database_Salasana = $Row['salasana'];
		}
	}
	else
	{
		//Debuggausta -->
		//echo $_SESSION['encrypt_salasana'] . " " . $Sahkoposti;
		unset($_SESSION['sahkoposti']); 
		//die("Väärä käyttäjätunnus tai salasana!");
		$_SESSION['incorrect'] = TRUE;
		header("location: login.php");
	}

	if($Sahkoposti == $Database_Sahkoposti && $Salasana == $Database_Salasana)
	{

		// Kirjautuminen on onnistunut
		header('Location: profile.php');
	}


?>
