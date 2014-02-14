<?php
	
	class Example
	{
		public $item = 'this is an item';
		public $name;

		function Sample()
		{
			$this->Test();
		}

		function Test()
		{
			echo 'Test';
			echo $this->item;

			$regular = 500;
			echo $regular;
		}

		function Fox()
		{
			$this->FoxSay();
		}

		function FoxSay()
		{
			echo "YAP";
		}
	}

	$e = new Example();
	$e->Sample();
	$e->Fox();
?>