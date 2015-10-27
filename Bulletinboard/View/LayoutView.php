<?php

class LayoutView
{

	public function Render($View)
	{	
		echo '<!DOCTYPE html>
	      <html>
	        <head>
	        <link rel="stylesheet" href="style.css">
	          <meta charset="utf-8">
	          <title>Bulletinboard</title>
	        </head>
	        <body>
	          <h1>Bulletinboard</h1>
	          
	          <div class="container">
	              ' . $View->Response() . '
	          </div>
	         </body>
	      </html>
	    ';
	}

	



}