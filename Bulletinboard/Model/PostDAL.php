<?php

class PostDAL
{

	private $conn;

	public function Initialize()
	{
		$host = Settings::mysql_host;
		$user = Settings::mysql_user;
		$password = Settings::mysql_password;
		$db = Settings::mysql_db;

		$this->conn = mysqli_connect($host, $user, $password, $db);

	}

	public function AddPost(Post $post)
	{
		$postContent = $post->GetContent();
		$signature = $post->GetSignature();
		$childposts = $post->GetChildPosts();
		$PostCategory = $post->GetCategory();

		$postContent = mysqli_escape_string($this->conn, $postContent);
		$signature = mysqli_escape_string($this->conn, $signature);
		$childposts = mysqli_escape_string($this->conn, $childposts);


		mysqli_query($this->conn, "INSERT INTO post (Post, Signature, Childpost, CategoryID) VALUES ('$postContent', '$signature', '$childposts', '$PostCategory')");
	}

	public function GetPostsByCategory()
	{


		$res = $this->conn->query("SELECT Post, Signature, Childpost, CategoryID FROM post WHERE CategoryID = 3");

		$allrows = array();

		//fetch_assoc() returns null when there are no rows to be fetched
		//As a result, the while loop will stop because null ain't 'true'
		while ($row = $res->fetch_array())
		{
			//var_dump($row);
		    array_push($allrows,$row);
		}

		$res->free();

		$this->conn->close();

		//var_dump($allrows);

		return isset($allrows) ? $allrows : null;

	}

	
}