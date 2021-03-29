<?php
include_once("Model.inc.php");

class Product extends Model
{
	public $id;
    public $name;
    public $desc;
    public $price;

	// Put the rest of the instance vars here

	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */
	public function __construct($args = []){

		$this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? "";
        $this->desc = $args['desc'] ?? "";
        $this->price = $args['price'] ?? 0;
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
        if(!$this->name){
            $valid = false;
            $this->validationErrors['name'] = "The product name is not valid";
        }
        if(!$this->desc){
            $valid = false;
            $this->validationErrors['desc'] = "The product description is not valid";
        }
        if(!$this->price > 0){
            $valid = false;
            $this->validationErrors['price'] = "The product price must be greater than 0";
        }

		// validate the rest of the instance vars
	}

}