<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Role.inc.php");
include_once(__DIR__ . "/../dataaccess/RoleDataAccess.inc.php");


class RoleController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	public function handle_roles(){

		
		$da = new RoleDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				// start off with just this inside this braanch
				$data = $this->getJSONRequestBody();

				$role = $da->convertRowToModel($data);
				if($role->isValid()){
					try{
						$role = $da->insert($role);
						$json = json_encode($role);

						$this->setContentType('json');
						$this->sendHeader(200);
						$this->allowCors();

						echo $json;
						die();
					}catch(Exception $e){
						$this->sendHeader(500,true, $e->getMessage());
					}
				}else{
					$msg = implode(', ', array_values($role->validationErrors));
					$this->sendHeader(400, true, $msg);
					die();
				}
				break;
			case "GET":
				$roles = $da->getAll();
				$json_roles = json_encode($roles, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				echo $json_roles;
				die();
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

	public function handle_single_role(){
		
		$url_path = $this->getUrlPath();
		$url_path = $this->removeLastSlash($url_path);
		//echo($url_path);

		// extract the role id
		$id = null;		
		if(preg_match('/^roles\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new RoleDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				$role = $da->getById($id);
				$json = json_encode($role, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				$this->sendHeader(200);
				echo $json;
				die();
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$role = $da->convertRowToModel($data);
				if($role->isValid()){
					try{
						if($da->update($role)){
							$json = json_encode($role);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($role->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				if($role = $da->getById($id)){
					try{
						$role->active = "no";
						$da->update($role, true);
						$this->sendHeader(200);
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$this->sendHeader(400, msg: "Unable to delete role, id: $id");
				}
			case "OPTIONS":
				// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
				// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
				header("Access-Control-Allow-Methods: GET,PUT,DELETE");
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}

	

}