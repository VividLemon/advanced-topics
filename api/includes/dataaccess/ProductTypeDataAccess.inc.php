<?php
// This example was the starter file I used for the product_typeDataAccess
// You may want to replace all occurences of product_type and $product_type with what ever model you are working with

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/Product_type.inc.php"); // I had problems including this file, not sure why!


class ProductTypeDataAccess extends DataAccess{

	    /**
	    * Constructor function for this class
	    * @param $link      A preconfigured connection to the database
	    */
	    function __construct($link){
			parent::__construct($link); //call the super constructor
	    }

	    /**
	    * Converts a model object into an assoc array and sets the keys
	    * to the proper names. For example a $user->id is converted to $row['user_id']
	    * The data should also be scrubbed to prevent SQL injection attacks
	    *
	    * @param {product_type} $product_type 
	    * @return {array}
	    */
	    function convertModelToRow($product_type){
	    	$row['id'] = mysqli_real_escape_string($this->link, $product_type->id);
			$row['product_type_name'] = mysqli_real_escape_string($this->link, $product_type->product_type_name);
			$row['product_type_desc'] = mysqli_real_escape_string($this->link, $product_type->product_type_desc);
			$row['active'] = mysqli_real_escape_string($this->link, $product_type->active);
			return $row;
	    }

	    /**
	    * Converts a row from the database to a model object
	    * And scrubs the data to prevent XSS attacks
	    *
	    * @param {array} $row
	    * @return {product_type}		Returns a subclass of a Model 
	    */
	    function convertRowToModel($row){
	    	$product_type = new Product_type();
			if(isset($row['id'])){
				$product_type->id = htmlentities($row['id']);
			}
			$product_type->product_type_name = htmlentities($row['product_type_name']);
			$product_type->product_type_desc = htmlentities($row['product_type_desc']);
			$product_type->active = htmlentities($row['active']);
			return $product_type;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $id 	The id of the item to get from a row in the database
	    * @return {product_type}		Returns an instance of a model object 
		* Returns false if fails
	    */
	    function getById($id){
			$qstr = "SELECT type_id as id, product_type_name, product_type_desc, active
			from product_type
			where type_id = " . mysqli_real_escape_string($this->link, $id);

			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
			if($result->num_rows == 1){
				$row = mysqli_fetch_assoc($result);
				$product_type = $this->convertRowToModel($row);
				return $product_type;
			}else{
				return false;
			}
	    }

	    /**
	    * Gets all rows from a table in the database
	    * @param {assoc array} 	This optional param would allow you to filter the result set
	    * 						For example, you could use it to somehow add a WHERE claus to the query
	    * 
	    * @return {array}		Returns an array of product_type objects
	    */
	    function getAll($args = []){
			$qstr = "SELECT type_id as id, product_type_name, product_type_desc, active
			from product_type
			where active = 'yes'";

			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
			$all = array();
			while($row = mysqli_fetch_assoc($result)){
				$product_type = $this->convertRowToModel($row);
				$all[] = $product_type;
			}
			return $all;
	    }


	    /**
	    * Inserts a row into a table in the database
	    * @param {product_type}	$product_type	The model object to be inserted
	    * @return {product_type}		Returns the same model object, but with the id property set 
	    *						(the id is assigned by the database)
		* Returns handleError() and false if fails
	    */
	    function insert($product_type){
			$row = $this->convertModelToRow($product_type);
			$qstr = "INSERT INTO product_type(
				product_type_name, 
				product_type_desc,
				active
				) VALUES (
				'{$row['product_type_name']}',
				'{$row['product_type_desc']}',
				'{$row['active']}'
				)";
				$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
				if($result){
					$product_type->id = mysqli_insert_id($this->link);
					return $product_type;
				}else{
					$this->handleError("Unable to insert product type");
					return false;
				}
	    }

	    /**
	    * Updates a row in a table of the database
	    * @param {product_type}	$product_type	The model object to be updated
		* @param {boolean} $delete 		If true, will prepare for "deleting"
		*								and will submit the correct handleError()
	    * @return {boolean}		Returns true if the update succeeds
		* Returns handleError() and false if fails
	    */
	    function update($product_type, $delete = false){
			$row = $this->convertModelToRow($product_type);
			$qstr = "UPDATE product_type SET 
			product_type_name = '{$row['product_type_name']}',
			product_type_desc = '{$row['product_type_desc']}',
			active = '{$row['active']}'
			WHERE type_id = " . $row['id'];

			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));

			$mysqli_test = preg_split("/ +/", mysqli_info($this->link));
			$records = (int)$mysqli_test[2]; 
			$changes = (int)$mysqli_test[4];

			if($delete){
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Product type is already non-active");
					return false;
				}else{
					$this->handleError("Unable to delete product type");
					return false;
				}
			}else{
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Unable to update a product type with no changes");
					return false;
				}else{
					$this->handleError("Unable to update product type");
					return false;
				}
			}
	    }


	    /**
	    * Deletes a row from a table in the database
	    * @param {number} 	The id of the row to delete
	    * @return {boolean}	Returns true if the row was sucessfully deleted, false otherwise
	    */
	    function delete($id){
	    	// should we really delete a row?
	    	// it can get super tricky when there are foreign keys!
	    }
}

#TODO fix all params