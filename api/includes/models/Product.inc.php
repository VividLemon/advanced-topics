<?php
include_once("Model.inc.php");

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
		if (($this->id >= 0) == false) {
			$valid = false;
			$this->validationErrors['id'] = "ID is not valid";
		}
        if(!$this->product_name){
            $valid = false;
            $this->validationErrors['name'] = "The product name is not valid";
        }
        if(!$this->product_desc){
            $valid = false;
            $this->validationErrors['desc'] = "The product description is not valid";
        }
        if(!$this->product_price > 0){
            $valid = false;
            $this->validationErrors['price'] = "The product price must be greater than 0";
        }
		if(!$this->type_id > 0){
			$valid = false;
			$this->validationErrors['type_id'] = "There must be a valid type id";
		}

		// validate the rest of the instance vars
		return $valid;
	}
	
}