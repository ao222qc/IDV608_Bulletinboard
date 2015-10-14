<?php

class BulletinView
{

//private static $GoToFirstPage = 'BulletinView::GoToFirstPage';
private static $ListallCategories = 'BulletinView::ListallCategories';
private static $ListSpecificCategory = 'BulletinView::ListSpecificCategory';
private static $submit = 'BulletinView::Submit';
private static $category = 'BulletinView::Category';
private static $post = 'BulletinView::Post';
private static $signature = 'BulletinView::Signature';
private static $childpost = 'BulletinView::Childpost';
private $CategoryList;
private $PostList;
private $BulletinPage;

	
	public function __construct()
	{
		
	}

	public function SetPageToDisplay()
	{
		if(isset($_GET["Post"]))
		{
			$this->BulletinPage = $this->GeneratePostHTML();
		}
		else if (isset($_GET["View"]))
		{
			$this->BulletinPage = $this->GenerateViewPostsHTML();
		}
		else
		{
			$this->BulletinPage = $this->GenerateFirstPage();
		}
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
				<a href=?Post>Create a post</a></form>
				<a href=?View>View posts</a></form>
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
			  <textarea rows="5" cols="80" id="' . self::$post .'" name = "' . self::$post .'" class="post"></textarea>
			  <input type="submit" id="' . self::$submit . '" name="' . self::$submit . '" value="Submit"/>
			 <a href=?Start>Back</a></form>
			</fieldset>
			</form> 
		';
	}

	public function GenerateViewPostsHTML()
	{
		$html =
		'	<form method="post">
			<fieldset>
			<legend>Select category to watch!</legend>
			<div id="categorymenu">
				  <br>
			    <select id="' . self::$category . '" name = "' . self::$category . '">
					<option value="' . $this->CategoryList[0]['CategoryID'] .'">' . $this->CategoryList[0]['Category'] .'</option>
					<option value="' . $this->CategoryList[1]['CategoryID'] .'">' . $this->CategoryList[1]['Category'] .'</option>
					<option value="' . $this->CategoryList[2]['CategoryID'] .'">' . $this->CategoryList[2]['Category'] .'</option>
					<option value="' . $this->CategoryList[3]['CategoryID'] .'">' . $this->CategoryList[3]['Category'] .'</option>
					<option value="' . $this->CategoryList[4]['CategoryID'] .'">' . $this->CategoryList[4]['Category'] .'</option>
				</select>
				<input type="submit" id="' . self::$ListSpecificCategory . '" name="' . self::$ListSpecificCategory . '" value="Show specific posts"/>
				<input type="submit" id="' . self::$ListallCategories . '" name="' . self::$ListallCategories . '" value="Show all"/>
				<a href=?Start>Back</a></form>
				</div>
				</fieldset>
				</form>
		';

		if(isset($this->PostList))
		{
			foreach($this->PostList as $post)
			{
				$html .=  
				'	
					<form method="post">
					<div id="PostList">
					<fieldset class="post">
					<legend>'. $this->CategoryList[$post['CategoryID']-1]['Category'] . '</legend>
					<div class="Signature">
					'.$post['Signature'].' 
					</div>
					<div class="content">
					' .$post['Post'] . '
					</div>	
					<input type="submit" id="' . self::$childpost . '" name="' . self::$childpost . '" value="Reply"/>
					</fieldset>		
					</div>
					</form>	
					<br>
				';
			}
		}

		return $html;
	}

	public function HasUserChosenShowAll()
	{
		return isset($_POST[self::$ListallCategories]);
	}

	public function HasUserChosenCategory()
	{
		return isset($_POST[self::$ListSpecificCategory]);
	}

	public function UserPressedReply()
	{
		return isset($_POST[self::$childpost]);
	}

	public function GetPostForReply()
	{
		//someshit
	}

	/*public function SetBulletinPostPage()
	{
		$this->BulletinPage = $this->GeneratePostHTML();
	}*/

	public function SetBulletinViewPostPage()
	{
		$this->BulletinPage = $this->GenerateViewPostsHTML();
	}
	/*
	public function UserWantsToPost()
	{

		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if(isset($_POST[self::$GoToPost]))
		{
			header('LOCATION:' . $actual_link . '?Post');
		}
	}
	

	public function UserWantsToViewPosts()
	{
		return isset($_GET['View']);
	}
	*/

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