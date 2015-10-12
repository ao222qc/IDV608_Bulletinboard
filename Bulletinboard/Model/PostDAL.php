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

		mysqli_query($this->conn, "INSERT INTO post (Post, Signature, Childpost, CategoryID) VALUES ('$postContent', '$signature', '$childposts', '$PostCategory')");
	}

	
}