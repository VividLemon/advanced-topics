<?php
include_once("Model.inc.php");
include_once("config.inc.php");

class User extends Model
{

	// INSTANCE VARIABLES
	

	
	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */
	public function __construct(
		public int $id = 0,
		public string $user_first_name = "",
		public string $user_last_name = "",
		public string $user_email = "",
		public int $user_role_id = 0,
		public string $user_password = "",
		public string $user_salt = "",
		public string $user_active = "",
	)
	{
		
	}

	/**
	 * Validates the state of this object. 
	 * Returns true if it is valid, false otherwise.
	 * For any properties that are not valid, a key will be added
	 * to the validationErrors array and it's value will be a description of the error.
	 * 
	 * @return {boolean}
	 */
	public function isValid()
	{

		$valid = true;
		$this->validationErrors = [];
		
		// validate id
		if (($this->id >= 0) == false) {
			$valid = false;
			$this->validationErrors['id'] = "ID is not valid";
		}

		// validate first name
		if (empty($this->user_first_name)) {
			$valid = false;
			$this->validationErrors['user_first_name'] = "First Name is required";
		}else if(strlen($this->user_first_name) > NAME_LENGTH){
			$valid = false;
			$this->validationErrors['user_first_name'] = "First Name must be less than " . NAME_LENGTH ." characters";
		}

		// validate lastName
		if (empty($this->user_last_name)) {
			$valid = false;
			$this->validationErrors['user_last_name'] = "Last Name is required";
		}else if(strlen($this->user_last_name) > NAME_LENGTH){
			$valid = false;
			$this->validationErrors['user_last_name'] = "Last Name must be less than " . NAME_LENGTH . " characters";
		}

		// validate email
		if (empty($this->user_email)){
			$valid = false;
			$this->validationErrors['user_email'] = "Email is required";
		}else if(!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$this->validationErrors['user_email'] = "The email address is not valid";
		}else if(strlen($this->user_email) > 255){
			$valid = false;
			$this->validationErrors['user_email'] = "The email address must be less than 255 characters";
		}

		// role id should be a number greater than zero
		if (!($this->user_role_id > 0)) {
			$valid = false;
			$this->validationErrors['user_roleId'] = "Role id is not valid";
		}

		// password should not be empty
		// do we need to enforce password strength????
		// the length should not be validated because we'll be using encryption, which should force it to be a certain length
		if (empty($this->user_password)) {
			$valid = false;
			$this->validationErrors['user_password'] = "Password is required";
		}

		// salt does not need validation

		// active must be either 'yes' or 'no'
		if ($this->user_active != "yes" && $this->user_active != "no") {
			$valid = false;
			$this->validationErrors['user_active'] = "Active must be either 'yes' or 'no'";
		}

		return $valid;
	}

}
