<?php

	require 'lib/nusoap.php';
	$client = new nusoap_client("http://www.jmdprojects.net/webservice/php/service.php?wsdl");
	$book_name = "xyz";
	$price = $client->call('price', array("name"=>"$book_name"));
	echo $price;

?>