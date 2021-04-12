<?php
include_once("Model.inc.php");
include_once("config.inc.php");

class Role extends Model
{
	

	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */
	public function __construct(
		public int $id = 0,
		public string $role_name = "",
		public string $role_desc = "",
		public string $active = "yes",
	){
		
	}

	/**
	 * Validates the state this object. 
	 * Returns true if it is valid, false otherwise.
	 * For any properties that are not valid, a key will be added
	 * to the validationErrors array and it's value will be a description of the error.
	 * 
	 * @return {boolean}
	 */
	function isValid(){
		
		$valid = true;
		$this->validationErrors = [];


		if(!($this->id >= 0)){
			$valid = false;
			$this->validationErrors['id'] = "ID is not valid";
		}

		// name should be 30 characters or less
		// description should be 200 characters or less
		if(empty($this->role_name)){
			$valid = false;
			$this->validationErrors['name'] = "Name is required";
		}else if(strlen($this->role_name) > NAME_LENGTH){
			$valid = false;
			$this->validationErrors['name'] = "Name must be less than " . NAME_LENGTH . " characters";
		}

		if(empty($this->role_desc)){
			$valid = false;
			$this->validationErrors['description'] = "Description is required";
		}else if(strlen($this->role_desc) > DESC_LENGTH){
			$valid = false;
			$this->validationErrors['description'] = "Description must be less than " . DESC_LENGTH . " characters";
		}

		if($this->active != "yes" && $this->active != "no"){
			$valid = false;
			$this->validationErrors['active'] = "Active must be either 'yes' or 'no'";
		}

		return $valid;
	}
}