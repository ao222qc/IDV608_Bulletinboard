<?php

class BulletinView
{

private static $submit = 'BulletinView::Submit';
private static $category = 'BulletinView::Category';
private static $post = 'BulletinView::Post';
private static $signature = 'BulletinView::Signature';

	
	public function Response()
	{

		$response = '';

		$response = $this->generatePostHTML();
	
		return $response;

	}

	public function generatePostHTML()
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
				  <option value="1">Music</option>
				  <option value="2">Politics</option>
				  <option value="3">Video games</option>
				  <option value="4">Film</option>
				  <option value ="5">News</option>
				</select> 
				<br>
			  Post:<br>
			  <textarea rows="5" cols="80" id="' . self::$post .'" name = "' . self::$post .'" class="Post"></textarea>
			  <input type="submit" id="' . self::$submit . '" name="' . self::$submit . '" value="Submit"/>
			</fieldset>
			</form> 
		';
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