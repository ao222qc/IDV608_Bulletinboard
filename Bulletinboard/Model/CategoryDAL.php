<?php

class CategoryDAL
{
	private $CategoryList = array();


	public function Initialize()
	{
		$host = Settings::mysql_host;
		$user = Settings::mysql_user;
		$password = Settings::mysql_password;
		$db = Settings::mysql_db;

		$this->conn = mysqli_connect($host, $user, $password, $db);

		$result = $this->conn->query("SELECT CategoryID, Category FROM category");

		//$allrows = array();

		while ($row = $result->fetch_array())
		{
		    array_push($this->CategoryList, $row);
		}

		$result->free();

		$this->conn->close();
	}

	public function GetCategoryList()
	{
		return $this->CategoryList;
	}

	public function __construct()
	{}




		


}