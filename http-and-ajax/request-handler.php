<?php
session_start(); // we'll be playing with sessions later in this activity
$_SESSION["username"] = "Fido";
$_SESSION['role'] = "Admin";

/*
// HERE'S HOW YOU CAN GET ALL THE INFORMATION ABOUT A REQUEST IN PHP...

$_SERVER['REQUEST_METHOD'];				Tells you the method/type of request (GET, POST, etc.)
$_SERVER['REQUEST_URI'];				Tells you the URL being requested (include the query string)
file_get_contents('php://input');		This function returns the body of the request
getallheaders();						This function returns an array of all headers in the request
$_GET									This array inlcudes the URL parameters in the query string
$_POST									This array includes all the user input entered into a form
*/


//sleep(8); // We'll uncomment this when we start using AJAX

// Note: You must set all response headers before you echo anything out
// These function calls will write response headers
//set_response_headers();
//set_cookies();
//set_headers_from_session_vars();

// This will write the response body
echo(get_request_data());
die();

// Gets all information out of the HTTP request and echos it out in the response body
function get_request_data(){

	$str = "";

	$str .= "REQUEST METHOD: {$_SERVER['REQUEST_METHOD']} \n";
	$str .= "REQUEST URI: {$_SERVER['REQUEST_URI']} \n\n";

	$str .= "REQUEST HEADERS...\n";
	$request_headers = getallheaders();
	foreach ($request_headers as $key => $value) {
		$str .= "$key : $value \n";
	}

	if(!empty($_GET)){
		$str .= "\nQUERY STRING PARAMS... \n";
		foreach ($_GET as $key => $value) {
			$str .= "$key : $value \n";
		}
	}

	if(!empty($_POST)){
		$str .= "\nPOST PARAMS... \n";
		foreach ($_POST as $key => $value) {
			$str .= "$key : $value \n";
		}
	}

	$request_body = file_get_contents('php://input');
	if(!empty($request_body)){
		$str .= "\nREQUEST BODY... \n";
		$str .= $request_body;
	}

	return $str;

}


//////////////////// STEP 2 - Setting Response Headers (and the respons body) //////////////////////////////

// We can use  the developer tools to look at the response headers sent from the server
function set_response_headers(){
	
	// Setting the status code of an HTTP response in PHP - http://php.net/manual/en/function.header.php
	// All status codes - http://www.restapitutorial.com/httpstatuscodes.html
	
	// Note that you cannot send a header after any content has been sent, even spaces

	// Here's a listing of common response (and request) headers
	// https://en.wikipedia.org/wiki/List_of_HTTP_header_fields


	// START HERE...
	//header("Invalid request - we can't handle this request", true, 400);
	//(the second param, if true, will overwrite a previous header if it conflicts with this one)
	// header('HTTP/1.1 401 Unauthorized');die();
    // header('HTTP/1.1 402 Payment Required');die();
 	// header('HTTP/1.1 403 Forbidden');die();
 	// header('HTTP/1.1 404 Not Found');die();


	// Custom response headers
	// You can add your own custom response headers, it used to be recommonded to start custom header names with "X-"
	// But now I'm not so sure:  https://stackoverflow.com/questions/3561381/custom-http-headers-naming-conventions
 
	//header("X-username: Bob");

	

	// Setting the Content-Type header 
	// (this should match the content that is being sent in the response body)
	// Here's a listing of common content-types:
	// https://en.wikipedia.org/wiki/Media_type

	//header('Content-Type: text/html');
	//echo("<h3>HELLO</h3>");
	//die();
	

	//Responding with JSON in the body
	//header('Content-Type: application/json');
	//echo('{msg:"HELLO!"}');
	//die();
}

//////////////////// STEP 3 - Cookies///////////////////////////////////////
function set_cookies(){

	setcookie("my-cookie", "foo");
	// to delete a cookie:
	//setcookie("my-cookie", null, time() - 1000);

	if(!isset($_COOKIE['page-counter'])){
		setcookie("page-counter", 1);
	}else{
		// If the page-counter cookie has been set then use it to update $visits
		$visits = $_COOKIE['page-counter'];
		if(is_numeric($visits)){
			$visits += 1;
			setcookie("page-counter", $visits);
			header("X-page-counter: $visits"); 
		}
	}
}

function set_headers_from_session_vars(){
	header("X-username: {$_SESSION['username']}");
	header("X-userrole: {$_SESSION['role']}");
}

?>
