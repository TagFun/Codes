<?php
	ini_set("display_errors", true);
	date_default_timezone_set("Europe/Helsinki");
	define("DB_DSN", "mysql:host=mysql1.sigmatic.fi;dbname=jmdproje_cms");
	define("DB_USERNAME", "jmdproje_konami");
	define("DB_PASSWORD", "password");
	define("CLASS_PATH", "classes");
	define("TEMPLATE_PATH", "templates");
	define("HOMEPAGE_NUM_ARTICLES", 5);
	define("ADMIN_USERNAME", "tagfun");
	define("ADMIN_PASSWORD", "password");
	require(CLASS_PATH . "/Article.php");

	/*function handleException($exception)
	{
		echo "Sorry, a problem occurred. Please try later.";
		error_log($exception->getMessage() );
	}

	set_exception_handler("handleException");*/
?>