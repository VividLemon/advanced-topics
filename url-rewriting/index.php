<?php

/*
By installing the Mod Rewrite plugin for Apache, we can use URL Rewriting.
This allows you to capture the url path requested and redirect all requests to this page (index.php)
The .htaccess file configures Mod Rewrite to work like this:
	All requests to files in this folder (or sub folders) will be routed to this page.
	The path requested will be appended to the redirect to this page.
	
	For example: The request to:

		users/some-user.html 

	Will 'secretly' get redirected to:

		index.php?url_path=users/some-user.html

	Notice that the requested path gets appended as a query string variable.
	We can access this variable through the $_GET super global array
*/
$path = $_GET['path'];
echo("The page you requested: <b>{$path}</b><br>");
echo("The php script that is running: <b>{$_SERVER['SCRIPT_FILENAME']}</b><br>");
die();

?>