<?php


/*
 * @author Nina Ranta | TagFun
 */


	session_start();

	if(!isset($_SESSION['sahkoposti']))
	{
		die("Kirjaudu sis��n");
	}

	$Sahkoposti = $_SESSION['sahkoposti'];

	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");

	if (!$connect)
  	{
  		die('ei voitu yhdist��: ' . mysql_error());
  	}

	$DB = mysql_select_db('jmdproje_kyselyjarjestelma');


	/*
	if($_GET["salasana"] != NULL)
	{
		$Salasana = $_GET["salasana"];
		$Query = mysql_query("UPDATE kayttajat SET Salasana = '$Salasana' WHERE Salasana = '$Salasana'");
	}

	else
	{
		die("M��rit� salasana!");
	} */

	if($_GET["etunimi"] != NULL)
	{
		$Etunimi = $_GET["etunimi"];
		$Query = mysql_query("UPDATE kayttajat SET Etunimi = '$Etunimi' WHERE Etunimi = '$Etunimi'");
	}

	else
	{
		die("M��rit� etunimi!");
	}

	if($_GET["sukunimi"] != NULL)
	{
		$Sukunimi = $_GET["sukunimi"];
		$Query = mysql_query("UPDATE kayttajat SET Sukunimi = '$Sukunimi' WHERE Sukunimi = '$Sukunimi'");
	}

	else
	{
		die("M��rit� sukunimi!");
	}

	if($_Get["ika"] != NULL)
	{
		$Ika = $_GET["ika"];
		$Query = mysql_query("UPDATE kayttajat SET Ika = '$Ika' WHERE Ika = '$Ika'");
	}

	else
	{
		die("M��rit� ik�!");
	}

	if($_GET["sukupuoli"] != NULL)
	{
		$Sukupuoli = $_GET["sukupuoli"];
		$Query = mysql_query("UPDATE kayttajat SET Sukupuoli = '$Sukupuoli'  WHERE Sukupuoli = '$Sukupuoli'");
	}

	else
	{
		die("M��rit� sukupuoli!");
	}

	

?>
