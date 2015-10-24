<?php

class BulletinController
{

	private $Category;
	private $Post;
	private $Poststyle;
	private $BulletinView;
	private $DataValidation;
	private $CategoryDAL;

	public function __construct(Category $Category, Post $Post, Poststyle $Poststyle, BulletinView $BulletinView, DataValidation $dataValidation, CategoryDAL $categorydal)
	{
		$this->Category = $Category;
		$this->Post = $Post;
		$this->Poststyle = $Poststyle;
		$this->BulletinView = $BulletinView;
		$this->DataValidation = $dataValidation;
		$this->CategoryDAL = $categorydal;
	}

	public function DoControl()
	{
		//Fetches the cached Categorylist from CategoryDAL. Sends to bulletinview.
		$this->BulletinView->LoadCategories($this->CategoryDAL->GetCategoryList());



		$this->BulletinView->SetPageToDisplay();

		if($this->BulletinView->HasUserSubmitted())
		{
			$this->AddPost();	
		}

		if($this->BulletinView->HasUserChosenCategory())
		{
			$this->GetPostsByCategory();
		}

		if($this->BulletinView->HasUserChosenShowAll())
		{
			$this->GetPosts();
		}
		if($this->BulletinView->UserPressedReply())
		{
			$signature = $this->BulletinView->UserPressedReply();

			$this->GetPostBySignature($signature);
		}
	}

	public function AddPost()
	{	
		$Post = null;

		$content = $this->BulletinView->GetPost();
		$category = $this->BulletinView->GetCategory();
		$signature = $this->BulletinView->GetSignature();

		//if valid will return true, also returns Post object that I create in DataValidation.
		if($this->DataValidation->IsDataValid($content, $signature, $category, $Post))
		{
			$this->Category->SetCategory($category);

			$this->Post->AddPostToDataBase($Post);
		}
		else
		{
			echo 'forgot to enter something huh';
		}
	}

	public function GetPosts()
	{
		$posts = $this->Post->GetAllPosts();

		$this->BulletinView->GetPosts($posts);

		$this->BulletinView->SetPageToDisplay();
	}

	public function GetPostsByCategory()
	{
		$posts = $this->Post->GetPostsByCategory($this->BulletinView->GetCategory());

		$this->BulletinView->GetPosts($posts);

		$this->BulletinView->SetPageToDisplay();
	}

	public function GetPostBySignature($signature)
	{
		$post = $this->Post->GetPostsBySignature($signature);

		$this->BulletinView->GetPostForReply($post);

		$this->BulletinView->SetPageToDisplay();

	}

}