<?php
	require 'functions.php';
	require_once('lib/nusoap.php');
	$server = new nusoap_server();
	$server->configureWSDL("webservice","urn:webservice");
	$server->register(
				"price",
				array("name"=> 'xsd:string'),
				array("return"=> "xsd:intger")
				);

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>