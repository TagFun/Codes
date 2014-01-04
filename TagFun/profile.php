<?php
	
// ---------------------------------CONNECTING TO DATABASE----------------------------------------

	session_start();

	// Yhdistäminen tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","NINNI123");

	if (!$connect)
	{
		die("MySQL could not connect!");
	}

	$DB = mysql_select_db('jmdproje_tagfun');

	if(!$DB)
	{
		die("MySQL ei voinut yhdistää tietokantaan");
	}
	
	//echo $_SESSION['sahkoposti']. "  ";

	if(isset($_SESSION['sahkoposti']))
	{
		$Sahkoposti = $_SESSION['sahkoposti'];
	}

	else
	{
		echo "Kyseistä käyttäjätunnusta ei löydy";
	}

	
	// Etsitään käyttäjä
	$Query = mysql_query("SELECT * FROM kayttajat WHERE Sahkoposti='$Sahkoposti'");
	
	if(mysql_num_rows($Query) != 1)
	{
		echo "Kyseistä käyttäjää ei löydy";
	}

	else
	{
		while($row = mysql_fetch_assoc($Query))
		{
			//$Sahkoposti = $row->Sahkoposti;
			$Etunimi = $row["Etunimi"];
			$Sukunimi = $row["Sukunimi"];
			$Yritys = $row["Yritys"];
			$Ika = $row["Ika"];
			$Sukupuoli = $row["Sukupuoli"];
			$Kuva = $row["Kuva"];
		}
		$_SESSION['sisalla'] = true;
		$_SESSION['sahkoposti'] = $Sahkoposti;
 
		if(isset($_SESSION['sisalla']) && $_SESSION['sahkoposti'] == $Sahkoposti)
              {
              	$pSivu = true;
              }

	}
?>

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

<!-- Seurantakoodi-->
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
                	<a href="logout.php/">Uloskirjaus</a>
                </div>

		<div class="templatemo_more">
                	<a href="http://www.jmdprojects.net/tagfun/index.html">Etusivu</a>
                </div>

                <div class="templatemo_more">
                	<a href="update.php">Muokkaa</a>
                </div>
                
                <div class="templatemo_more">
                	<a href="delete.php">Poista</a></div>
            </div>

	        </div><!-- End Of header -->
       


				<!-- --------------------------------- PROFILE PAGE --------------------------------------------- -->
                            	<header class = "container_12">
						<h2><?php echo $Sahkoposti?></h2><br>
					</header>

				<?php if(isset($pSivu)):?>
				<?php endif; ?>

				<div id = "main" class = "container_12">
				<aside class = "grid_3">
					<!-- <img src = "profiili.png"/> -->
				</aside>

				<section id = "primary" class = "grid_9">
					<div id = "bio">
					<!-- $Kuva täytyy hakea sql fetchillä --> 
					<img src="<?php echo $Kuva ?>"><br><br>

					<p><b>Nimi:</b> <?php echo $Etunimi?></p><br>
					<p><b>Sukunimi:</b> <?php echo $Sukunimi?></p><br>
					<p><b>Yritys:</b> <?php echo $Yritys?></p><br>
					<p><b>Ikä:</b> <?php echo $Ika?></p><br>
					<p><b>Sukupuoli:</b> <?php echo $Sukupuoli?></p><br><br>
				</section>
				<br><br><br><br>
				<form name="Image" enctype="multipart/form-data" action="update_profile_pic.php" method="POST">
    				<input type="file" name="kuva" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/>
   				<INPUT type="submit" class="button" name="Submit" value=" Submit ">
    				&nbsp;&nbsp;<INPUT type="reset" class="button" value="Cancel">
    				</form>
				<br><br><br><br>
			

<!-- --------------------------------------FOOTER----------------------------------------- -->
                            
        <div id="templatemo_footer">
        <img src="images/footertext.png">
	</div>
    </div><!-- End Of Container -->
  
<!--  Free CSS Templates by TemplateMo.com  -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
