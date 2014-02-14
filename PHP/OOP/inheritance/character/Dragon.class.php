<?php

	class Dragon extends Character
	{
		public function __construct($hp, $dmg, $armor)
		{
			parent::__construct();
			$this->hp = $hp;
			$this->dmg = $dmg;
			$this->armot = $armor;
		}

		public function Setup()
		{
		}
	}
?>