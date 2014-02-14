<?php

	// PHP OOP TUTORIAL | SCOPE & CALCULATOR

	class Calc
	{
		public $input;
		public $input2;
		private $output;

		function setInput($int) // <-- $int = 5
		{
			$this->input = (int) $int;
		}

		function setInput2($int) // <-- $int = 22
		{
			$this->input2 = (int) $int;
		}

		function getResult()
		{
			$this->output = $this->input * $this->input2;
			return $this->output;
		}

	}

	$calc = new Calc();
	$calc->setInput(5);
	$calc->setInput2(22);
	echo $calc->getResult();

?>
