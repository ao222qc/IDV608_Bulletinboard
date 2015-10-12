<?php

class Post
{
	private $PostID;
	private $Content;
	private $Signature;
	private $ChildPosts;
	private $CategoryID;
	private $Category;
	private $postDAL;
	//private $PoststyleID;

	public function __construct(Category $category, PostDAL $postDAL)
	{
		$this->Category = $category;
		$this->postDAL = $postDAL;
	}

	public function AddPost($post, $signature)
	{
		$this->Content = $post;
		$this->Signature = $signature;
		$this->CategoryID = $this->Category->GetCategoryID();

		$this->postDAL->AddPost($this);
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