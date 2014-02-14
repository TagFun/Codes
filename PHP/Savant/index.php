<?php

	require_once('Savant3-3.0.1/Savant3.php');
	
	$conf = array (
			'template_path' => 'templates'
			);

	$tpl = new Savant3($conf);

	$name = "Some of my favourite animes";
	$animes = array (
			array(
				'aname' => 'Fullmetal Alchemist',
				'genre' => 'Shounen'
			),

		       array (
				'aname' => 'Yu-Gi-Oh!',
				'genre' => 'Shounen'
			),
		);

	$tpl->title = $name;
	$tpl->animes = $animes;
	$tpl->display('animes.tpl.php');

?>