<?php

//---------------------------- CONNECTING TO DATABASE--------------------------------

	session_start();

	

	// Yhdist�minen tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","NINNI123");

	if (!$connect)
	{
		die("MySQL ei voitu yhdist��!");
	}

	$DB = mysql_select_db('jmdproje_tagfun');

	if(!$DB)
	{
		die("MySQL ei voinut yhdist�� tietokantaan");
	}

	// Muuttujien m��rittely
	$Sahkoposti = $_GET['sahkoposti'];
	$Salasana = $_GET['salasana'];
	
	// Kryptataan salasana
	// T�m�n j�lkeen k�ytet��n koko ajan $Encrypt_salasana
	$Encrypt_salasana = md5($Salasana);

	$Query = mysql_query("SELECT * FROM kayttajat WHERE Sahkoposti ='$Sahkoposti' AND Salasana = '$Encrypt_salasana'");
	$NumRows = mysql_num_rows($Query);
	$_SESSION['sahkoposti'] = $Sahkoposti;
	$_SESSION['encrypt_salasana'] = $Encrypt_salasana;

	// Tarkistetaan onko k�ytt�j� sy�tt�nyt kaikki tarvittavat tiedot
	if(empty($_SESSION['sahkoposti']) || empty($_SESSION['encrypt_salasana']))
	{
		// Lopetetaan sessio jos sy�tt�� tyhj�t tiedot
		unset($_SESSION['sahkoposti']); 
		die("Palaa takaisin ja rekister�idy p��st�ksesi sivustolle");
		//session_destroy();
	}

	if($Sahkoposti == "" && $Encrypt_salasana == "")
	{
		unset($_SESSION['sahkoposti']);
		die("Anna k�ytt�j�tunnus ja salasana!");
		//session_destroy();
	}

	if($Sahkoposti == "")
	{
		unset($_SESSION['sahkoposti']);
		die("Anna k�ytt�j�tunnus!" . "</br>");
		//session_destroy();
	}

	if($Encrypt_salasana == "")
	{
		unset($_SESSION['sahkoposti']); 
		die("Anna salasana!");
		echo "</br>";
		//session_destroy();
	}

	// K�ytt�j�tunnuksen ja salasanan tarkistaminen tietokannasta

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
		//die("V��r� k�ytt�j�tunnus tai salasana!");
		$_SESSION['incorrect'] = TRUE;
		header("location: login.php");
	}

	if($Sahkoposti == $Database_Sahkoposti && $Salasana == $Database_Salasana)
	{

		// Kirjautuminen on onnistunut
		header('Location: profile.php');
	}


?>
