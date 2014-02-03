<?php


/*
 * @author Nina Ranta | TagFun
 */


	session_start();

	// Yhdistäminen tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");

	if (!$connect)
	{
		die("MySQL ei voitu yhdistää!");
	}

	$DB = mysql_select_db('jmdproje_kyselyjarjestelma');

	if(!$DB)
	{
		die("MySQL ei voinut yhdistää tietokantaan");
	}

	// Muuttujien määrittely
	$Sahkoposti = $_SESSION['sahkoposti'];
	$Salasana = $_SESSION['salasana'];

	// Kuvanpäivittämiskansio
   	$uploadDir = 'images/';

   	if(isset($_POST['Submit']))
   	{
    		$TiedostoNimi = $_FILES['kuva']['name'];
    		$TmpNimi = $_FILES['kuva']['tmp_name'];
    		$TiedostoKoko = $_FILES['kuva']['size'];
    		$TiedostoTyyppi = $_FILES['kuva']['type'];
    		  
    		$Tulos = move_uploaded_file($TmpNimi, "upload/" . $TiedostoNimi);
		$TiedostoPolku= "upload/" . $TiedostoNimi;
   	 	if (!$Tulos) 
		{
    			echo "Virhe 404 kuvaa päivittäessä ";
    			exit;
    		}

   	 	if(!get_magic_quotes_gpc())
    		{
   			$TiedostoNimi = addslashes($TiedostoNimi);
    			$TiedostoPolku = addslashes($TiedostoPolku);
    		}

   		$Query = mysql_query("UPDATE kayttajat SET Kuva='$TiedostoPolku' WHERE Sahkoposti='$Sahkoposti' ");
		
    	}


?>