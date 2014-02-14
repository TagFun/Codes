<?php

	// Smarty Template Engine
	
	require_once('header.php');
	// key = 'Nina' | item = 22
	$array = array(
			'Nina'=>22,
			'joni'=>26,
			'Emma'=>22,
			'Ville'=>14
			);

	$date = '13-01-2014';
	$smarty->assign('date', $date);
	$smarty->assign('people', $array);
	
	$smarty->display('index.tpl');
?>