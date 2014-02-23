<?php
	ini_set("display_errors", true);
	date_default_timezone_set("Europe/Helsinki");
	define("DB_DSN", "mysql:host=mysql1.sigmatic.fi;dbname=jmdproje_test");
	define("DB_KAYTTAJATUNNUS", "jmdproje_konami");
	define("DB_SALASANA", "");
	define("TEMPLATE_PATH", "templates");

	/*function handleException($exception)
	{
		echo "Sorry, a problem occurred. Please try later.";
		error_log($exception->getMessage() );
	}

	set_exception_handler("handleException");*/
?>