<?php

	require_once('Log.class.php');
		
	$Log = new Log();
	//$Log->Write('test.txt', 'My name is Nina');
	echo $Log->Read('test.txt');

?>