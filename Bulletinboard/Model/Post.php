<?php

class Post
{
	private $PostID;
	private $Content;
	private $Signature;
	private $ChildPosts;
	private $CategoryID;
	private $Category;
	private static $postDAL;
	//private $PoststyleID;

	public static function Initialize()
	{
		self::$postDAL = new PostDAL();
		self::$postDAL->Initialize();
	}

	public function __construct($content, $signature, $category)
	{

		if($content != null && $signature != null && $category != null)
		{
			$this->Content = $content;
			$this->Signature = $signature;
			$this->CategoryID = $category;
		}

	}
	public function AddPostToDataBase(Post $post)
	{
		self::$postDAL->AddPost($post);
	}

	public function GetPostsByCategory($category)
	{
		$data = array();

		$data = self::$postDAL->GetPostsByCategory($category);

		return $data;
	}

	public function GetAllPosts()
	{

		$data = array();

		$data = self::$postDAL->GetAllPosts();

		return $data;

	}

	public function GetContent()
	{
		return $this->Content;
	}
	
	public function GetSignature()
	{
		return $this->Signature;
	}	

	public function GetChildPosts()
	{
		return $this->ChildPosts;
	}

	public function GetCategory()
	{
		return $this->CategoryID;
	}

}

/*
	public function GetStyle()
	{

	}
*/