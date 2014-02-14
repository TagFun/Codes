<?php

	class Human extends Character
	{
		public function Attack()
		{
			echo 1;
			$this->Setup(500, 300);
		}

		public function Defend() {}
		public function Sleep() {}
	}

?>