<?php

	class wordChanged
	{
		function clean($str)
		{
			$curzwords = array("Nina", "programming");
			$replacers = array("Liisa", "drawing");
			$cleanStr = str_ireplace($curzwords, $replacers, $str);
			return $cleanStr;
		}

	}	

?>