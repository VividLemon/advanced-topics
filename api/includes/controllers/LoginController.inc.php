<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/User.inc.php");
include_once(__DIR__ . "/../dataaccess/UserDataAccess.inc.php");


class LoginController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}
	
	// Make sure that session_start() is called in index.php
	// Make sure to add the routes for logging in and logging out
	// Run this SQL in the database (it sets all users passwords to 'test')
	// 		UPDATE users SET user_salt='ae43c38edb', user_password='$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu'
	// Use the LoginControlerTests.php page to test this page as we add code to it.

	public function handleLogin(){


		$this->allowCors(); // we'll add this later when we run into the issue

		$da = new UserDataAccess($this->link);

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				
				$data = $this->getJSONRequestBody();
				//print_r($data);
				//die();
				// if($user = $da->login($data['email'], $data['password'])){
				// 	print_r($user);
				// }else{
				// 	echo "Unable to authenticate";
				// }
				try{
					if($user = $da->login($data['email'], $data['password'])){
						$json = json_encode($user, JSON_PRETTY_PRINT);
						//create new sessionId
						session_regenerate_id();
						$_SESSION['authenticated'] = "yes";
						$_SESSION['user_id'] = $user->id;
						$_SESSION['user_role_id'] = $user->user_roleId;
						$_SESSION['user_first_name'] = $user->user_first_name;
						$this->setContentType("json");
						$this->sendHeader(200);
						echo $json;
						die();
					}else{
						throw new Exception("Invalid User Login");
					}
				}catch(Exception $e){
					$this->sendHeader(401, msg: "{$e->getMessage()}");
					die();
				}


			case "OPTIONS":
				// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
				// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
				header("Access-Control-Allow-Methods: POST");
				$this->sendHeader(200);
				die();
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
				die();
		}
	}


	public function handleLogout(){

		$this->allowCors();

		// destroy the session cookie
		if (isset( $_COOKIE[session_name()])){
			setcookie( session_name(), "", time()-3600, "/" );
		}
	    
	    //empty the $_SESSION array
		$_SESSION = array();
	    
	    //destroy the session on the server
		session_destroy();

		$this->sendHeader(200);

	}


}