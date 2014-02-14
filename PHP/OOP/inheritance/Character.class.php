<?php
	class Character
	{
		protected $hp = 100;
		protected $dmg = 10;
		protected $mp = 10;

		protected function __construct()
		{
			echo "The character was created";
		}

		public function Attack()
		{
			echo "We attacked for " . $this->dmg;	
		}
	}

?>