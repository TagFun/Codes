<?php

	class Log
	{

	/**
	* @desc	writes to a file
	* @param str	$strFileName	the name of the file
	* @param str	$strData	Data to be appended to the file
	*/
		public function Write($strFileName, $strData)
		{
			if(!is_writable($strFileName))
			die('Change your CHMOD permissions to ' . $strFileName);

			$handle = fopen($strFileName, 'a+');

			fwrite($handle, $strData . "\r");
			fclose($handle);

	/**
	* @desc	reads a file
	* @param str	$strFileName	the name of the file
	* @return	str	the text file
	*/
		}

		public function Read($strFileName)
		{	
			$handle = fopen($strFileName, 'r');
			return file_get_contents($strFileName);
		}
	}
?>