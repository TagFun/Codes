<?php
	require("config.php");
	session_start();
	$action = substr(curPageURL(), 53, 8);
	if($action != "editUser")
	{
		$action = substr(curPageURL(), 46, 8);
	}

	$Kayttajatunnus = isset($_SESSION['kayttajatunnus']) ? $_SESSION['kayttajatunnus'] : "";
	$Kayttajataso = isset($_SESSION['kayttajataso']) ? $_SESSION['kayttajataso'] : "";
	//--------------------------------------------------------------------------------
	function login()
	{
		$results = array();
		$results['pageTitle'] = "Login";

		if(isset($_POST['login']))
		{	
			$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");

			if (!$connect)
  			{
  				die('ei voitu yhdistää: ' . mysql_error());
  			}

			$DB = mysql_select_db('jmdproje_test');

			$Kayttajatunnus = $_POST['kayttajatunnus'];
			$Salasana = $_POST['salasana'];
			$Query = mysql_query("SELECT * FROM Kayttajat WHERE Kayttajatunnus ='$Kayttajatunnus' AND Salasana = '$Salasana'");
			while($row = mysql_fetch_assoc($Query))
			{
				$DB_Kayttajatunnus = $row['Kayttajatunnus'];
				$DB_Salasana = $row['Salasana'];
				$DB_Kayttajataso = $row['Kayttajataso'];
			}

			// Admin has posted login form: attempt to log the admin in
			if($_POST['kayttajatunnus'] == $DB_Kayttajatunnus && $_POST['salasana'] == $DB_Salasana && $DB_Kayttajataso == "admin")
			{
				// Login successful: Create a session and redirect to the admin homepage
				$_SESSION['kayttajatunnus'] = $DB_Kayttajatunnus;
				$_SESSION['kayttajataso'] = $DB_Kayttajataso;
				header("Location: index.php");
			}

			
			// User has posted login form: attempt to log the user in
			elseif($_POST['kayttajatunnus'] == $DB_Kayttajatunnus && $_POST['salasana'] == $DB_Salasana && $DB_Kayttajataso == "user")
			{
				// Login successful: Create a session and redirect to the user homepage
				$_SESSION['kayttajatunnus'] = $DB_Kayttajatunnus;
				$_SESSION['kayttajataso'] = $DB_Kayttajataso;
				header("Location: index.php");
			}

			else
			{
				// Login failed: Display an error message to the user
				$results['errorMessage'] = "Incorrect username or password. Please try again";
				require(TEMPLATE_PATH . "/source/login.php");
			}
		}
	
		else
		{
			// User has not posted the login form yet: Display the form
			require(TEMPLATE_PATH . "/source/login.php");
		}
	}

	//-----------LOGOUT -----------------------
	function logout()
	{
		//session_start();
		session_destroy();
		
		$Kayttajatunnus = "";

		login();
		exit;
	}

	//-----------EDIT USER -----------------------
	function editUser()
	{

		session_start();

		$connect = mysql_connect("mysql1.sigmatic.fi","jmdproje_konami","");
		mysql_select_db('jmdproje_test', $connect);

		if (!$connect)
		{
			die("MySQL could not connect!");
		}

		$Kayttajatunnus = $_SESSION['kayttajatunnus'];

		if (!$connect)
  		{
  			die('ei voitu yhdistää: ' . mysql_error());
  		}

		// ID-numero jos tullaan ajax-hausta----------------------------------------------------
		$muutettavaKayttaja = substr(curPageURL(), -1);
		$ID = intval($muutettavaKayttaja);
		//--------------------------------------------------------------------------------------

		$Query = mysql_query("SELECT * FROM Kayttajat WHERE ID = '$ID'");

		if($Query === FALSE) {
    			die(mysql_error()); // TODO: better error handling
		}

		$result = array();

		while($row = mysql_fetch_array($Query))
		{
			$result[] = $row;
		}

		//echo $result[0]['Etunimi'];

		require(TEMPLATE_PATH . "/source/editUser.php");

		// ID-numero jos tullaan formilta ----------------------------------------------------
		$ID = $_GET["ID"];
		//------------------------------------------------------------------------------------

		if($_GET["kayttajataso"] != NULL)
		{
			$Kayttajataso = $_GET["kayttajataso"];
			mysql_query("UPDATE Kayttajat SET Kayttajataso = '$Kayttajataso' WHERE ID = '$ID'");
		}

		if($_GET["kayttajatunnus"] != NULL)
		{
			$Kayttajatunnus = $_GET["kayttajatunnus"];
			echo " ID: ".$ID." ja käyttäjätunnus: ".$Kayttajatunnus;
			mysql_query("UPDATE Kayttajat SET Kayttajatunnus = '$Kayttajatunnus' WHERE ID = '$ID'");				
		}
	
		if($_GET["salasana"] != NULL)
		{
			$Salasana = $_GET["salasana"];
			mysql_query("UPDATE Kayttajat SET Salasana = '$Salasana'  WHERE ID = '$ID'");
		}

		if($_GET["etunimi"] != NULL)
		{
			$Etunimi = $_GET["etunimi"];
			mysql_query("UPDATE Kayttajat SET Etunimi = '$Etunimi' WHERE ID = '$ID'");
		}

		if($_GET["sukunimi"] != NULL)
		{
			$Sukunimi = $_GET["sukunimi"];
			mysql_query("UPDATE Kayttajat SET Sukunimi = '$Sukunimi' WHERE ID = '$ID'");
		}
	
		if($_GET["ika"] != NULL)
		{
			$Ika = $_GET["ika"];
			mysql_query("UPDATE Kayttajat SET Ika = '$Ika' WHERE ID = '$ID'");
		}

		if($_GET["sukupuoli"] != NULL)
		{
			$Sukupuoli = $_GET["sukupuoli"];
			mysql_query("UPDATE Kayttajat SET Sukupuoli = '$Sukupuoli' WHERE ID = '$ID'");
		}

		if($_GET["yritys"] != NULL)
		{
			$Yritys = $_GET["yritys"];
			mysql_query("UPDATE Kayttajat SET Yritys = '$Yritys' WHERE ID = '$ID'");
		}

		if($_GET["puhnum"] != NULL)
		{
			$Puhnum = $_GET["puhnum"];
			mysql_query("UPDATE Kayttajat SET Puhnum = '$Puhnum' WHERE ID = '$ID'");
		}

	}
	

	//-----------GET PAGE URL -----------------------
	function curPageURL() 
	{
 		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") 
		{
			$pageURL .= "s";
		}
 		$pageURL .= "://";
 		if ($_SERVER["SERVER_PORT"] != "80") 
		{
  			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 		} 
	
		else 
		{
  			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 		}

 		return $pageURL;
	}

	//----------- USERCONTROL -----------------------
	function userControl()
	{

		//$results = array();
		//$results['pageTitle'] = "Käyttäjänhallinta";

		
		?><form action="index.php">
		<input type="submit" value="Lopeta käyttäjähallinta" name="quit">
		</form> <?php


		//----------- AJAX LIVE SEARCH -----------------------

		require(TEMPLATE_PATH . "/source/userControl.php");

		
		//-----------------KÄYTTÄJÄHALLINAN LOPETTAMINEN----------------------------

		if(!isset($_REQUEST['quit']))
		{
			exit();
		}	
	}

	
	// ----------------------KÄYTTÄJÄTASON TARKISTAMINEN---------------------------------

	//----------- ADMIN KÄYTTÄJÄTASO -----------------------
	if($Kayttajataso == "admin")
	{
		// Kaikki toiminnallisuus mitä admin voi tehdä
		
		
		if($action == "editUser")
		{
			editUser();
		}
		
		if(isset($_REQUEST['logout']))
		{
			logout();
		}

		elseif(isset($_REQUEST['userControl']))
		{
			userControl();
		}

		else
		{
			?><form action="index.php">
			<input type="submit" value="Kirjaudu ulos" name="logout">
			<input type="submit" value="Käyttäjähallintaan" name="userControl">
			</form> <?php
		}
	}

	//----------- USER KÄYTTÄJÄTASO -----------------------
	elseif($Kayttajataso == "user")
	{
		
		//Kaikki toiminnallisuus mitä user voi tehdä
		
		
		if(isset($_REQUEST['logout']))
		{
			logout();
		}

		else
		{
			?><form action="index.php">
			<input type="submit" value="Kirjaudu ulos" name="logout">
			</form> <?php
		}
	}

	//----------- TIETOKANNASTA EI LÖYDY TIETOJA -----------------------
	else
	{
		// Kirjautumista ei suoritettu
		login();
		exit;
	}

?>