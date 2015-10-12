<?php

class BulletinController
{

	private $Category;
	private $Post;
	private $Poststyle;
	private $BulletinView;

	public function __construct(Category $Category, Post $Post, Poststyle $Poststyle, BulletinView $BulletinView)
	{
		$this->Category = $Category;
		$this->Post = $Post;
		$this->Poststyle = $Poststyle;
		$this->BulletinView = $BulletinView;
	}

	public function DoControl()
	{

		if($this->BulletinView->HasUserSubmitted())
		{
			$post = $this->BulletinView->GetPost();
			$category = $this->BulletinView->GetCategory();
			$signature = $this->BulletinView->GetSignature();

			//TODO: Send em through some validation before saving.

			$this->Category->SetCategory($category);

			$this->Post->AddPostToDatabase($post, $signature);
		}

	}
	
}