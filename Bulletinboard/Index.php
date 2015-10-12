<?php

require_once('Settings.php');
require_once('View/BulletinView.php');
require_once('Model/Category.php');
require_once('Model/Post.php');
require_once('Controller/BulletinController.php');
require_once('Model/PostDAL.php');
require_once('Model/Poststyle.php');
require_once('View/LayoutView.php');
require_once('Settings.php');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


$Category = new Category();
$PostDAL = new PostDAL();
$Post = new Post($Category, $PostDAL);
$Poststyle = new Poststyle();
$View = new BulletinView();
$LayoutView = new LayoutView();

$PostDAL->Initialize();



$bulletinController = new BulletinController($Category, $Post, $Poststyle, $View);

$bulletinController->DoControl();

$LayoutView->Render($View);


	
