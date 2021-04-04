<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Employee_department.inc.php");
include_once(__DIR__ . "/../dataaccess/Employee_departmentDataAccess.inc.php");


class EmployeeDepartmentController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}
	#TODO ALL CONTROLLERS NEED TO BE FIXED FOR CORS

	public function handle_employee_departments(){

		$da = new EmployeeDepartmentDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				$data = $this->getJSONRequestBody();

				$employee_department = new Department($data);

				if($employee_department->isValid()){
					try{
						$employee_department = $da->insert($employee_department);
						$json = json_encode($employee_department);
						
						$this->setContentType("json");
						$this->sendHeader(200);
						$this->allowCors();
						 
						echo $json;
						die();
					}catch(Exception $e){
						$this->sendHeader(500, true, $e->getMessage());
					}
				}else{
					$msg = implode(", ", array_values($employee_department->validationErrors));
					$this->sendHeader(400, true, $msg);
					die();
				}

				break;
			case "GET":
				$employee_departments = $da->getAll();
				$json_employee_departments = json_encode($employee_departments, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				echo $json_employee_departments;
				die();
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

		// extract the employee_department id
		$id = null;		
		if(preg_match('/^employee_departments\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new EmployeeDepartmentDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				$employee_department = $da->getById($id);
				$json = json_encode($employee_department, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				$this->sendHeader(200);
				echo $json;
				die();
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$employee_department = new Department($data);
				if($employee_department->isValid()){
					try{
						if($da->update($employee_department)){
							$json = json_encode($employee_department);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($employee_department->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				echo("DELETE employee_department $id");
				break;
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