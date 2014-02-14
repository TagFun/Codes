<?php

	class Log
	{

		private $_FileName;
		private $_Data;

	/**
	* @desc	writes to a file
	* @param str	$strFileName	the name of the file
	* @param str	$strData	Data to be appended to the file
	*/
		public function Write($strFileName, $strData)
		{
			// Set Class Vars
			$this->_FileName = $strFileName;
			$this->_Data = $strData;
			
			// Check Data
			$this->_CheckPermission();
			$this->_CheckData();
			$handle = fopen($strFileName, 'a+');

			// Write the file
			fwrite($handle, $strData . "\r");
			fclose($handle);

	
		}

		/**
		* @desc	reads a file
		* @param str	$strFileName	the name of the file
		* @return	str	the text file
		*/

		public function Read($strFileName)
		{	
			$this->_FileName = $strFileName;
			$this->_CheckExists();
			$handle = fopen($strFileName, 'r');
			return file_get_contents($strFileName);
		}

		/**
		*@desc Check it the file being called exists
		*/

		private function _CheckExists()
		{
			if(file_exists($this->_FileName))
				die('The file does not exists');
		}		

		private function _CheckPermission()
		{
			if(!is_writable($this->_FileName))
			{
				die('Change your CHMOD permissions to ' . $this->_FileName);
			}
		}

		private function _CheckData()
		{
			if(strlen($this->_Data) < 1)
			{
				die('You must have more then one character in data');
			}
		 }
	}
?>