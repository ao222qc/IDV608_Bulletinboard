<?php

class DataValidation
{


	public function __construct()
	{
	
	}

	public function IsDataValid($post, $signature, $category, &$Post)
	{
		$valid = null;

		//TODO: IMPLEMENT textfile with errors and ErrorString.php class
		if($post == NULL || $signature == NULL || $category == NULL)
		{
			$valid = false;
		}
		else
		{
			$valid = true;
			$Post = new Post($post, $signature, $category);
		}

		//TODO: Implement further validation for some reason, kinda useless I guess. REGEX, check for html tags etc. 

		return $valid;
	}
}