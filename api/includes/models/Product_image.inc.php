<?php
include_once("Model.inc.php");
include_once("config.inc.php");

class Product_image extends Model
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
        public int $product_id = 0,
        public string $path = '',
		public string $active = 'yes',
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

        if(!($this->product_id >= 0)){
            $valid = false;
            $this->validationErrors['product_id'] = "Product ID is not valid";
        }

        if(empty($this->path)){
            $valid = false;
            $this->validationErrors['path'] = "The product path is not valid";
        }else if(strlen($this->path) > 255){
            $valid = false;
            $this->validationErrors['path'] = "The path must be less than 255 characters";
        }
		
		if($this->active != "yes" && $this->active != "no"){
			$valid = false;
			$this->validationErrors['active'] = "Active must be either 'yes' or 'no'";
		}


		// validate the rest of the instance vars
		return $valid;
	}
	
}