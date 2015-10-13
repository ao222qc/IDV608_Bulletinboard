<?php

class BulletinView
{

private static $GoToPost = 'BulletinView::GoToPost';
private static $GoToViewPosts = 'BulltinView::GoToViewPosts';
private static $submit = 'BulletinView::Submit';
private static $category = 'BulletinView::Category';
private static $post = 'BulletinView::Post';
private static $signature = 'BulletinView::Signature';
private $CategoryList;
private $PostList;
private $BulletinPage;

	
	public function __construct()
	{
		$this->BulletinPage = $this->GenerateFirstPage();
	}

	
	public function Response()
	{

		$response = '';

		$response = $this->BulletinPage;
	
		return $response;
	}

	public function LoadCategories($categorylist)
	{
		$this->CategoryList = $categorylist;
	}

	public function GetPosts($postlist)
	{
		$this->PostList = $postlist;
	}


	public function GenerateFirstPage()
	{
		return 
		'
			<form method ="post">
			<fieldset>
			<legend>View user posts or create your own!</legend>
				<input type="submit" id="' . self::$GoToPost .'" name="'. self::$GoToPost .'" value="Create your own"/><br><br>
				<input type ="submit" id="' . self::$GoToViewPosts . '" name="' . self::$GoToViewPosts . '" value="View posts"/>
			</fieldset>
			</form>

		';
	}

	public function GeneratePostHTML()
	{
		return 
		'
			<form method ="post">
			<fieldset>
			<legend>Write your bulletin blog post thingy!</legend>
			  Signature:<br>
			  <input type="text" id="' . self::$signature .'" name="' . self::$signature . '">
			  <br>
			  <label for="' . self::$category . '">Choose category:</label>
			  <br>
			    <select id="' . self::$category . '" name = "' . self::$category . '">
					<option value="' . $this->CategoryList[0]['CategoryID'] .'">' . $this->CategoryList[0]['Category'] .'</option>
					<option value="' . $this->CategoryList[1]['CategoryID'] .'">' . $this->CategoryList[1]['Category'] .'</option>
					<option value="' . $this->CategoryList[2]['CategoryID'] .'">' . $this->CategoryList[2]['Category'] .'</option>
					<option value="' . $this->CategoryList[3]['CategoryID'] .'">' . $this->CategoryList[3]['Category'] .'</option>
					<option value="' . $this->CategoryList[4]['CategoryID'] .'">' . $this->CategoryList[4]['Category'] .'</option>
				</select> 
				<br>
			  Post:<br>
			  <textarea rows="5" cols="80" id="' . self::$post .'" name = "' . self::$post .'" class="Post"></textarea>
			  <input type="submit" id="' . self::$submit . '" name="' . self::$submit . '" value="Submit"/>
			</fieldset>
			</form> 
		';
	}

	public function GenerateViewPostsHTML()
	{
		$html = null;
		foreach($this->PostList as $post)
		{
			$html .=  
			'		
				<fieldset>
				<legend>'. $this->CategoryList[$post['CategoryID']-1]['Category'] . '</legend>
				<div class="Signature">
				'.$post['Signature'].' 
				</div>
				<div id="Post">
				' .$post['Post'] . '
				</div>	
				</fieldset>			
			';
		}

		return $html;
	}

	public function SetBulletinPostPage()
	{
		$this->BulletinPage = $this->GeneratePostHTML();
	}

	public function SetBulletinViewPostPage()
	{
		$this->BulletinPage = $this->GenerateViewPostsHTML();
	}

	public function UserWantsToPost()
	{
		return isset($_POST[self::$GoToPost]);
	}
	public function UserWantsToViewPosts()
	{
		return isset($_POST[self::$GoToViewPosts]);
	}

	public function IsCategorySet()
	{
		return isset($_POST[self::$category]);
	}

	public function GetCategory()
	{
		if($this->IsCategorySet())
		{
			return $_POST[self::$category];
		}
	}

	public function HasUserSubmitted()
	{
		return isset($_POST[self::$submit]);
	}

	public function IsPostSet()
	{
		return isset($_POST[self::$post]);
	}

	public function GetPost()
	{
		if($this->IsPostSet())
		{
			return $_POST[self::$post];
		}
	}

	public function IsSignatureSet()
	{
		return isset($_POST[self::$signature]);
	}

	public function GetSignature()
	{
		if($this->IsSignatureSet())
		{
			return $_POST[self::$signature];
		}
	}



}

/*	  */