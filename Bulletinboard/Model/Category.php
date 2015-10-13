<?php

class Category
{
	private $CategoryID;
	private $CategoryName;
	//private $CategoryDescription;

	public function GetCategoryID()
	{
		return $this->CategoryID;
	}

	public static function GetCategoryName()
	{
		return $this->CategoryName;
	}

	public function SetCategory($categoryid)
	{
		$this->CategoryID = $categoryid;

		switch($this->CategoryID)
		{
			case 1:
			$this->CategoryName = "Music";
			break;
			case 2:
			$this->CategoryName = "Politics";
			break;
			case 3:
			$this->CategoryName = "Video games";
			break;
			case 4:
			$this->CategoryName = "Film";
			break;
			case 5:
			$this->CategoryName = "News";
			break;
			default:
			$this->CategoryName = "Category not available";
			break;
		}
	}
}




	/*public function GetCategoryDescription()
	{
		return $this->CategoryDescription;
	}*/