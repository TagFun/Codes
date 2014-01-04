<?php

//---------------------------------STARTING SESSION-----------------------------------------
	session_start();
	if(isset($_SESSION['sahkoposti']))
	{
		header('Location: profile.php');
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>TagFun | Nina Ranta</title>
<link rel="icon" type="image/png" href="/tagfun/images/icon.png"/>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<!-- ------------------- GOOGLE ANALYTICS CODE------------- -->
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
                	<a href="register.html">Rekisteröidy</a>
                </div>
                
                <div class="templatemo_more">
                	<a href="http://www.jmdprojects.net/tagfun/index.html">Etusivu</a></div>
                </div>

	 </div>
	 
	  <!-- -----------End Of header------------ -->
        

<!-- ---------------------------------------------------LOGIN FORM---------------------------------------------- -->
	<link rel="stylesheet" href="css/style.css">
	<div class="container">
    	<section class="login">
		<h1>Kirjaudu sisään</h1>
      		<form method="get" action="login_valid.php">
      			<div class="reg_section personal_info">
      			<div class="reg_section password">
      				<h3>Säköposti*</h3>
      					<input type="text" name="sahkoposti" value="" placeholder="Sähköposti toimii  käyttäjätunnuksena">      			<div class="reg_section password">
      				<h3>Salasana*</h3>
					<input type="password" name="salasana" value="" placeholder="Anna salasana">
      			</div>
      			<p class="submit"><input type="submit" name="commit" value="Kirjaudu"></p>
      		</form>
    	</section>
	</div>


<!-- ---------------FOOTER-------------------------- -->
                            
        <div id="templatemo_footer">
        	<img src="images/footertext.png">
	</div>
</div>

<!-- ----------End Of Container----------- -->
  
<!--  Free CSS Templates by TemplateMo.com  -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
