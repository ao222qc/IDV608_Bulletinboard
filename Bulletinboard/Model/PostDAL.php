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

		$postContent = strip_tags($postContent);
		$signature = strip_tags($signature);
		$childposts = strip_tags($childposts);

		$postContent = mysqli_escape_string($this->conn, $postContent);
		$signature = mysqli_escape_string($this->conn, $signature);
		$childposts = mysqli_escape_string($this->conn, $childposts);

		mysqli_query($this->conn, "INSERT INTO post (Post, Signature, CategoryID) VALUES ('$postContent', '$signature', '$PostCategory')");
	}

	public function AddReply($post, $reply)
	{
		$postid = $post['PostID'];

		mysqli_query($this->conn, "INSERT INTO Reply (Reply, PostID) VALUES ('$reply', '$postid')");
	}

	public function GetPostsByCategory($category)
	{

		$result = $this->conn->query("SELECT PostID, Post, Signature, CategoryID FROM post WHERE CategoryID = '$category'");

		$allrows = array();

		while ($row = $result->fetch_array())
		{
			$row["replies"] = array();

			$replyresult = $this->conn->query('SELECT * FROM Reply WHERE PostID='.$row["PostID"]);

			while ($replyrow = $replyresult->fetch_assoc())
			{
				array_push($row["replies"], $replyrow);
			}

		    array_push($allrows, $row);
		}

		$result->free();

		//$this->conn->close();

		return isset($allrows) ? $allrows : null;
	}	

	public function GetPostsBySignature($signature)
	{
		$result = $this->conn->query("SELECT PostID, Post, Signature, CategoryID FROM post WHERE Signature = '$signature'");

		$allrows = array();

		while ($row = $result->fetch_array())
		{

			$row["replies"] = array();

			$replyresult = $this->conn->query('SELECT * FROM Reply WHERE PostID='.$row["PostID"]);

			while ($replyrow = $replyresult->fetch_assoc())
			{
				array_push($row["replies"], $replyrow);
			}
		    array_push($allrows, $row);
		}

		$result->free();

		//$this->conn->close();

		return isset($allrows) ? $allrows : null;
	}

	public function GetAllPosts()
	{
		//$result = $this->conn->query('SELECT * FROM Post LEFT JOIN Reply ON Reply.PostID = Post.PostID');

		$result = $this->conn->query('SELECT * FROM Post');
		$allrows = array();

		while ($row = $result->fetch_assoc())
		{
			$row["replies"] = array();

			$replyresult = $this->conn->query('SELECT * FROM Reply WHERE PostID='.$row["PostID"]);

			while ($replyrow = $replyresult->fetch_assoc())
			{
				array_push($row["replies"], $replyrow);
			}

		    array_push($allrows, $row);
		}

		$result->free();

		//$this->conn->close();


		return isset($allrows) ? $allrows : null;
	}

	public function GetAllReplies()
	{

		$result = $this->conn->query('SELECT * FROM Reply');

		$allrows = array();

		while ($row = $result->fetch_array())
		{
		    array_push($allrows, $row);
		}

		$result->free();

		//$this->conn->close();

		return isset($allrows) ? $allrows : null;
	}
}