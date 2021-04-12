<?php
include_once("Model.inc.php");
include_once("config.inc.php");

class Employee extends Model
{

	// Put the rest of the instance vars here

	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */
	public function __construct(
		public int $id = 0,
		public int $user_id = 0,
		public string $employee_dob = "",
		public int $employee_salary = 0,
		public string $employee_part_time = "no",
		public string $active = "yes",
	){

	}


	/**
	* Validates the state of a this Model object. 
	* Returns true if it is valid, false otherwise
	* Note that when you implement this method, you should populate the inherited validationErrs array
	* with a key for each property that is not valid, the value should be a description of the error.
	* For example: If the 'id' property of this object is not valid:
	* 		$this->validationErrors['id'] = "The id must be a valid number"
	* 
	* @return {boolean}
	*/
	function isValid(){
		
		$valid = true;
		$this->validationErrors = [];

		// valide the id
		if(!($this->id >= 0)){
			$valid = false;
			$this->validationErrors['id'] = "The id is not valid";
		}

		if(!($this->user_id >= 0)){
			$valid = false;
			$this->validationErrors['user_id'] = "The user id is not valid";
		}

		if(empty($this->employee_dob)){
			$valid = false;
			$this->validationErrors['dob'] = "Date of birth is required";
		}

		if(empty($this->employee_salary)){
			$valid = false;
			$this->validationErrors['salary'] = "Salary is required";
		}else if($this->employee_salary < 0){
			$valid = false;
			$this->validationErrors['salary'] = "Employee salary must be greater than 0";
		}

		if($this->employee_part_time != "yes" && $this->employee_part_time != "no"){
			$valid = false;
			$this->validationErrors['part_time'] = "Part time must be 'yes' or 'no'";
		}

		if($this->active != "yes" && $this->active != "no"){
			$valid = false;
			$this->validationErrors['active'] = "Active must be either 'yes' or 'no'";
		}

		return $valid;
		// validate the rest of the instance vars
	}

}