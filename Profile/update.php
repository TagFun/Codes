<?php


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

	$DB = mysql_select_db('jmdproje_profile');

?>

<!-- ---------------------------WEBSITE HEADER-------------------------------------------------------------- -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>TagFun | Nina Ranta</title>
<link rel="icon" type="image/png" href="/tagfun/images/icon.png"/>
<link href="styleUpdate.css" rel="stylesheet" type="text/css" />

</head>
<body>


	<link rel="stylesheet" type="text/css" href="StyleUpdate.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<div id="StyleSheet" class="UpdateForm">
	<div id = "BoxOfBoxes">
	<form id="form" name="form" method="get" action="update.php">
	<h1>Muokkaa tietojasi</h1>

	<!--
	<div id = "box1">
	<label>Salasana
	</label>
	<input type="password" name="salasana" id="salasana" />
	<br>
	</div>
	-->

	<div id = "box2">
	<label>Nimi
	</label>
	<input type="text" name="nimi" id="nimi" />
	<br>
	</div>

	<div id = "box3">
	<label>Yritys
	</label>
	<input type="text" name="yritys" id="yritys" />
	</div>

	<div id = "box4">
	<label>Ik�
	</label>
	<input type="num" name="ika" id="ika" />
	</div>

	</form>

<?php

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

	if($_GET["nimi"] != NULL)
	{
		$Nimi = $_GET["nimi"];
		$Query = mysql_query("UPDATE kayttajat SET Nimi = '$Nimi' WHERE Nimi = '$Nimi'");
	}

	else
	{
		die("M��rit� nimi!");
	}


	if($_GET["yritys"] != NULL)
	{
		$Yritys = $_GET["yritys"];
		$Query = mysql_query("UPDATE kayttajat SET Yritys = '$Yritys' WHERE Yritys = '$Yritys'");
	}

	else
	{
		die("M��rit� yritys!");
	}

	
	if($_GET["ika"] != NULL)
	{
		$Ika = $_GET["ika"];
		$Query = mysql_query("UPDATE kayttajat SET Ika = '$Ika' WHERE Ika = '$Ika'");
	}

	else
	{
		die("M��rit� ik�!");
	}

	

?>
