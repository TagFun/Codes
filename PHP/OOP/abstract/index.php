<?php

	// PHP OOP TUTORIAL | ABSTRACT CLASSES

	require_once('Character.class.php');
	require_once('Human.class.php');
	
	$user = new Human();
	$user->Attack();
	$user->Setup(1, 2);

?>