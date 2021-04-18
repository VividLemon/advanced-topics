<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/User.inc.php");
include_once(__DIR__ . "/../dataaccess/UserDataAccess.inc.php");


class UserController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	/*
	Notes
	- We need to secure resources!
	- A robust web service will look at the Accept header in the request
	  and return the data in the requested format (for example json, xml, csv, etc)
	*/

	public function handleUsers(){

		$da = new UserDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				// start off with just this inside this braanch
				if(!$this->isAdmin()){
					$this->sendHeader(401, msg: $this->default_unauthorized);
					die();
				}else{

					$data = $this->getJSONRequestBody();

					$user = $da->convertRowToModel($data);
					if($user->isValid()){
						try{
							$user = $da->insert($user);
							$json = json_encode($user);

							$this->setContentType('json');
							$this->sendHeader(200);
							$this->allowCors();

							echo $json;
							die();
						}catch(Exception $e){
							$this->sendHeader(500,true, $e->getMessage());
						}
					}else{
						$msg = implode(', ', array_values($user->validationErrors));
						$this->sendHeader(400, true, $msg);
						die();
					}
				}
				break;
			case "GET":
				if(!$this->isAdmin()){
					$this->sendHeader(401, msg: $this->default_unauthorized);
					die();
				}else{
					$users = $da->getAll();
					$jsonUsers = json_encode($users, JSON_PRETTY_PRINT);
					$this->setContentType("json");
					$this->sendHeader(200);
					$this->allowCors();

					echo($jsonUsers);
					die();
				}
				
				break;
			case "OPTIONS":
				// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
				// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
				$this->allowCors();
				header("Access-Control-Allow-Methods: GET,POST");
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}



	public function handleSingleUser(){

		$url_path = $this->getUrlPath();
		$url_path = $this->removeLastSlash($url_path);
		//echo($url_path);

		// extract the user id
		$id = null;		
		if(preg_match('/^users\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new UserDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				if(!$this->isAdmin() && !$this->isOwner($id)){
					$this->sendHeader(401, msg: $this->default_unauthorized);
					die();
				}else{
					//echo("GET USER $id");
					$user = $da->getById($id);
					$json = json_encode($user, JSON_PRETTY_PRINT);
					$this->setContentType("json");
					$this->sendHeader(200);
					echo $json;
					die();
				}
				
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$user = $da->convertRowToModel($data);
				if($user->isValid()){
					try{
						if($da->update($user, true)){
							$json = json_encode($user);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($user->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				if(!$this->isAdmin()){
					$this->sendHeader(401, msg: $this->default_unauthorized);
					die();
				}else{
					if($user = $da->getById($id)){
						try{
							$user->user_active = "no";
							$da->update($user, delete: true);
							$this->sendHeader(200);
						}catch(Exception $e){
							$this->sendHeader(400, true, $e->getMessage());
						}
						die();
					}else{
						$this->sendHeader(400, msg: "Unable to delete user, id: $id");
					}
				}
				break;
			case "OPTIONS":
				// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
				// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
				$this->allowCors();
				header("Access-Control-Allow-Methods: GET,PUT,DELETE");
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}


}