<?php

//------------------------------------------VERIFYING REGISTER IN PHP------------------------------------------ -->

	session_start();

	// Yhdistet��n tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");
	if (!$connect)
	{
		die("MySQL ei voida yhdistää");
	}

	$DB = mysql_select_db('jmdproje_tagfun');

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
		echo "Käyttäjätunnus " .$Sahkoposti. " on jo käytössä . "</br>";
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
		$subject = 'Kiitos rekister�innist�!';
		$message = "Tervetuloa käyttäjäksemme! \n" . "Kayttajatunnus: $Sahkoposti \n" . "Salasana: " . $Salasana;
		$headers = 'From: rekisteröityminen@tagfun.net' . "\r\n" .
    		'Reply-To: @example.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	

	
	}

?>

<!-- ------------------WEBSITE HEADER ------------------------------- -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>TagFun | Nina Ranta</title>
<link rel="icon" type="image/png" href="/tagfun/images/icon.png"/>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style.css">
<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<!-- ---------GOOGLE ANALYTICS CODE--------------- -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46435212-2', 'jmdprojects.net');
  ga('send', 'pageview');

</script>
</head>
<body>

	<div id="templatemo_container">
    	<div id="templatmeo_header">
        	<div id="templatemo_menu">
            	            </div>
            
            <div id="templatemo_logo_area">
            	<div id="templatemo_logo">
                	<img src = "images/tagfunprofile.png" width="500" height="200"></div>
            </div>
            
            <div class="templatemo_welcome"> 
                <div class="templatemo_more">
                	<a href="http://wwww.jmdprojects.net/tagfun/index.html">Etusivu</a></div>
            </div>

		 <div class="templatemo_more">
                	<a href="login.php">Kirjaudu</a></div>
            </div>

	        </div><!-- End Of header -->
		<style type="text/css">
		p {text-align: center; color: white;}
		</style>
		<p>Kiitos rekisteröitymisestä! Salasana on lähetetty sähköpostiinne</p>
		
<!-- ---------------------------------FOOTER----------------------------------------- -->
                            
        <div id="templatemo_footer">
        <img src="images/footertext.png">
	</div>
    </div><!-- End Of Container -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
