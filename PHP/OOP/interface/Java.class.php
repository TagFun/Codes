<?php

	class Java implements DotSyntax, Compiled
	{
		public function __construct()
		{
			echo "Java was created";
			$this->UsesDotSyntax();
		}

		public function UsesDotSyntax()
		{
			echo "yes it looks like this";
		}

		public function IsCompled()
		{
			echo "yes it creates jar files";
		}
	}

?>
			