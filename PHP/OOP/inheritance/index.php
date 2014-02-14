<?php

	// PHP OOP TUTORIAL | INHERITANCE & CONSTRUCTOR
	require_once('Character.class.php');
	require_once('character/Wolf.class.php');
	require_once('character/Dragon.class.php');	
	require_once('character/Human.class.php');

	$Character = new Dragon(150, 330, 20);
	$Character->Setup();
	$Character->Attack();

?>