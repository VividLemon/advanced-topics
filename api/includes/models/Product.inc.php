<?php
include_once("Model.inc.php");
include_once("config.inc.php");

class Product extends Model
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
        public string $product_name = "",
        public string $product_desc = "",
		public int $product_price = 0,
		public int $type_id = 0,
		public string $active = "yes",
    ) {

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
		if (!($this->id >= 0)){
			$valid = false;
			$this->validationErrors['id'] = "ID is not valid";
		}

        if(empty($this->product_name)){
            $valid = false;
            $this->validationErrors['name'] = "Product name is required";
        }else if(strlen($this->product_name) > NAME_LENGTH){
			"Name must be less than " . NAME_LENGTH . " characters";
		}

        if(empty($this->product_desc)){
            $valid = false;
            $this->validationErrors['desc'] = "Product description is required";
        }else if(strlen($this->product_desc) > DESC_LENGTH){
			"Description must be less than " . DESC_LENGTH . " characters";
		}

        if(empty($this->product_price)){
            $valid = false;
            $this->validationErrors['price'] = "Product price is required";
        }else if(strlen($this->product_price) < 0){
			$valid = false; 
			$this->validationErrors['price'] = "Product price must be greater than 0";
		}

		if(!($this->type_id >= 0)){
			$valid = false;
			$this->validationErrors['type_id'] = "There must be a valid type id";
		}

		if($this->active != "yes" && $this->active != "no"){
			$valid = false;
			$this->validationErrors['active'] = "Active must be either 'yes' or 'no'";
		}


		// validate the rest of the instance vars
		return $valid;
	}
	
}