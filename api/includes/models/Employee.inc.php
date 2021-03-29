<?php
include_once("Model.inc.php");

class Employee extends Model
{
	public $id;
    public $user_id;
    public $dob;
    public $salary;
    public $part_time;
	// Put the rest of the instance vars here

	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */
	public function __construct($args = []){

		$this->id = $args['id'] ?? 0;
        $this->user_id = $args['user_id'];
        $this->dob = $args['dob'] ?? new Date();
        $this->salary = $args['salary'] ?? 0;
        $this->part_time = $args['part_time'] ?? false;
		// set the rest of the instance vars
		
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
		if(!$this->id >= 0){
			$valid = false;
			$this->validationErrors['id'] = "The id is not valid";
		}
        if(!$this->user_id >= 0 || isset($this->user_id)){
            $valid = false;
            $this->validationErrors['user_id'] = "The user id is not valid.";
        }
        if(!$this->salary >= 0){
            $valid = false;
            $this->validationErrors['salary'] = "The salary must be a valid number";
        }
#TODO add more?

		// validate the rest of the instance vars
	}

}