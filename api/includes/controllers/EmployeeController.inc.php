<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Employee.inc.php");
include_once(__DIR__ . "/../dataaccess/EmployeeDataAccess.inc.php");


class EmployeeController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	public function handle_employees(){

		
		$da = new EmployeeDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				$data = $this->getJSONRequestBody();

				$employee = $da->convertRowToModel($data);

				if($employee->isValid()){
					try{
						$employee = $da->insert($employee);
						$json = json_encode($employee);
						
						$this->setContentType("json");
						$this->sendHeader(200);
						$this->allowCors();
						 
						echo $json;
						die();
					}catch(Exception $e){
						$this->sendHeader(500, true, $e->getMessage());
					}
				}else{
					$msg = implode(", ", array_values($employee->validationErrors));
					$this->sendHeader(400, true, $msg);
					die();
				}

				break;
			case "GET":
				$employees = $da->getAll();
				$json_employees = json_encode($employees, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				echo $json_employees;
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

	public function handle_single_employee(){
		
		$url_path = $this->getUrlPath();
		$url_path = $this->removeLastSlash($url_path);
		//echo($url_path);

		// extract the employee id
		$id = null;		
		if(preg_match('/^employees\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new EmployeeDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				$employee = $da->getById($id);
				$json = json_encode($employee, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				$this->sendHeader(200);
				echo $json;
				die();
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$employee = $da->convertRowToModel($data);
				if($employee->isValid()){
					try{
						if($da->update($employee)){
							$json = json_encode($employee);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($employee->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				if($employee = $da->getById($id)){
					try{
						$employee->active = "no";
						$da->update($employee, true);
						$this->sendHeader(200);
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$this->sendHeader(400, msg: "Unable to delete employee, id: $id");
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