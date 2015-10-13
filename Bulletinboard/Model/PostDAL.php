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

	public function GetPostsByCategory($category)
	{

		$result = $this->conn->query("SELECT Post, Signature, Childpost, CategoryID FROM post WHERE CategoryID = '$category'");

		$allrows = array();

		while ($row = $result->fetch_array())
		{
		    array_push($allrows, $row);
		}

		$result->free();

		$this->conn->close();

		return isset($allrows) ? $allrows : null;
	}	

	public function GetAllPosts()
	{
		$result = $this->conn->query("SELECT Post, Signature, Childpost, CategoryID FROM post");

		$allrows = array();

		while ($row = $result->fetch_array())
		{
		    array_push($allrows, $row);
		}

		$result->free();

		$this->conn->close();

		

		return isset($allrows) ? $allrows : null;
	}
}