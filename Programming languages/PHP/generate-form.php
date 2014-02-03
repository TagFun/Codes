<?php


/*
 * @author Nina Ranta | TagFun
 */


	// Aloitetaan istunto taulujen käsittelyä varten 
	session_start();

	//echo "Current session = ".$_SESSION['Current2']."<br>";
	//echo "Taulu0 = ".$_SESSION['taulu0']."<br>";
	//echo "Taulu1 = ".$_SESSION['taulu1']."<br>";
	

	// Vanhentumien (depracations) poistamiseksi, ota käyttöön allaoleva virheraportoinnin poisto.
	error_reporting(0);
	
	//echo $_SESSION['sahkoposti']."<br>";
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");
	mysql_select_db('jmdproje_kyselyjarjestelma', $connect);

	if (!$connect)
	{
		die("MySQL could not connect!");
	}
	?>

<!-- --------------------------------------------------------------
-------------------------------------------------------------------
---------------------- HERE'S SOME HTML CODE ----------------------
-------------------------------------------------------------------
-------------------------------------------------------------------
------------------------------------------------------------------- -->
	
<?php
	// Otetaan taulun nimeksi ajankohta vuosi-kuukausi-päivä-kellonaika
	$gen = date("Y-m-d-H:i:s");
	//echo $gen;
	
	// Rakennetaan sarakkeet
	$sarake = "";
	
	for($i=0;$i<100;$i++)
	{
		$t = "Kysymys".$i;
		$s = $_POST[$t];
		$s = str_replace(' ', '_', $s);

		if($s != "")
		{
			$sarake = $sarake.$s." VARCHAR(60), ";
		}
	}	

	$kysymykset = substr($sarake, 0, -2);
	
	// echo $sarake."<br>";
	// echo $kysymykset."<br>";

	// Luodaan taulu
	$sql_luo = "CREATE TABLE  `$gen` ($kysymykset)";

	if(mysql_query($sql_luo))
	{
		// echo "Taulu ". $gen . " luotu onnistuneesti";
	}

	else
	{
		// echo "Taulun luonti ei onnistunut" . mysqli_error($connect);
	}
	
	$_SESSION['Current']++;
	$Kysely = "Kysely".$_SESSION['Current'];
	echo $Kysely."<br>";
	// Varastoidaan kyselyn tekijälle taulu
	$Sql_varastoi = "UPDATE kayttajat SET `$Kysely` = '$gen' WHERE Sahkoposti = '$_SESSION[sahkoposti]'";
	if(mysql_query($Sql_varastoi))
	{
		//echo "Onnistui! <br>";
	}

	else
	{
		
	}
	$_SESSION['Current']--;
	// FormTableGenerator pitää olla kansiossa FTG
	require('FTG/FormTableGenerator.class.php');
	
	// Luodaan uusi taulugenerointi olio
	$FTG = new FormTableGenerator($connect);
	echo $FTG->generatePage($gen, 'Edit', 'http://www.jmdprojects.net/split_survey/survey_answered.php');
	
	$p = "linkki".$_SESSION['Current'];
	$_SESSION[$p] = "kysely_".$gen.".php";
	
	$_SESSION['Current']++;
	$r = "taulu".$_SESSION['Current'];	
	// echo $r."<br>";
	mysql_close($connect);

?>
	<!-- <a href="<?php echo "kysely_".$gen.".php"; ?>">Esikatsele</a><br> -->

<?php
	if($_SESSION[$r] == "")
	{
?>
	<a href="send_survey.php">Lähettäminen</a><br>
<?php
	}
	else
	{
?>
	<a href="<?php echo $_SESSION[$r].".php"; ?>">seuraava</a><br>
<?php	
	}
?>
