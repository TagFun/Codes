<?php

	// PHP OOP TUTORIAL | METHOD & SCOPE

	require_once('Log.class.php');
		
	$Log = new Log();
	$Log->Write('test.txt', 'HELLO WORLD');
	//echo $Log->Read('test.txt');

?>