<?php
	
	session_start();

	// Yhdistäminen tietokantaan
	$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");

	if (!$connect)
	{
		die("MySQL could not connect!");
	}

	$DB = mysql_select_db('jmdproje_profile');

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
			$Nimi = $row["Nimi"];
			$Yritys = $row["Yritys"];
			$Ika = $row["Ika"];
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
<link rel="stylesheet" href="css/style.css">

</head>
<body>
		<div id = "link">
                	<a href="logout.php/">Uloskirjaus</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://www.jmdprojects.net/tagfun/index.html">Etusivu</a><br><br>
			<a href="update.php">Muokkaa</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="delete.php">Poista</a></div>
	  	
            </div>


				<!-- ---------- PROFILE PAGE ---------------------- -->
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
					<p><b>Yritys:</b> <?php echo $Yritys?></p><br>
					<p><b>Ikä:</b> <?php echo $Ika?></p><br>
				</section>
				<br><br><br><br>
				<form name="Image" enctype="multipart/form-data" action="update_profile_pic.php" method="POST">
    				<input type="file" name="kuva" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/>
   				<INPUT type="submit" class="button" name="Submit" value=" Submit ">
    				&nbsp;&nbsp;<INPUT type="reset" class="button" value="Cancel">
    				</form>
</body>
</html>
