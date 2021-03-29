<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Employee.inc.php");
include_once(__DIR__ . "/../dataaccess/EmployeeDataAccess.inc.php");


class RoleController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	public function handleRoles(){

		
		$da = new RoleDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				// start off with just this inside this braanch
				
				
				break;
			case "GET":
				$roles = $da->getAll();
				$json_roles = json_encode($roles, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				echo $json_roles;
				die();
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}

	

}