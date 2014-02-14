<?php
	include_once("wordChanged.php");
	$wordChanged = new wordChanged;
	// --------------------------------
	$string = "My name is Nina and I like programming";
	$clean_str = ($wordChanged->clean($string));
	echo $clean_str;

?>