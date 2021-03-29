<?php
// This example was the starter file I used for the productDataAccess
// You may want to replace all occurences of product and $product with what ever model you are working with

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/product.inc.php"); // I had problems including this file, not sure why!


class productDataAccess extends DataAccess{

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
	    * @param {product} $product 
	    * @return {array}
	    */
	    function convertModelToRow($product){
	    	$row['product_id'] = mysqli_real_escape_string($this->link, $product->id);
	    	$row['product_name'] = mysqli_real_escape_string($this->link, $product->name);
	    	$row['product_desc'] = mysqli_real_escape_string($this->link, $product->description);
	    	$row['product_price'] = mysqli_real_escape_string($this->link, $product->price);
			return $row;
	    }

	    /**
	    * Converts a row from the database to a model object
	    * And scrubs the data to prevent XSS attacks
	    *
	    * @param {array} $row
	    * @return {product}		Returns a subclass of a Model 
	    */
	    function convertRowToModel($row){
	    	$product = new product();
            $product->name = htmlentities($row['product_name']);
            $product->desc = htmlentities($row['product_desc']);
            $product->price = htmlentities($row['product_price']);
            return $product;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $id 	The id of the item to get from a row in the database
	    * @return {product}		Returns an instance of a model object 
	    */
	    function getById($id){
            $qstr = "SELECT product_id, product_name, product_desc, product_price FROM products WHERE product_id = " . mysqli_real_escape_string($this->link, $id);
            $result = mysqli_real_escape_string($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
            if($result->num_rows == 1){
                $row = mysqli_fetch_assoc($result);
                $product = $this->convertRowToModel($row);
                return $product;
            }else{
                return false;
            }
	    }

	    /**
	    * Gets all rows from a table in the database
	    * @param {assoc array} 	This optional param would allow you to filter the result set
	    * 						For example, you could use it to somehow add a WHERE claus to the query
	    * 
	    * @return {array}		Returns an array of model objects
	    */
	    function getAll($args = []){
            $qstr = "SELECT * FROM products";
            $result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
            while($row = mysqli_fetch_assoc($result)){
                $product = $this->convertRowToModel($row);
                $all[] = $product;
            }
            return $all;
	    }


	    /**
	    * Inserts a row into a table in the database
	    * @param {product}	$product	The model object to be inserted
	    * @return {product}		Returns the same model object, but with the id property set 
	    *						(the id is assigned by the database)
	    */
	    function insert($product){
            $row = $this->convertModelToRow($product);
			$qStr = "INSERT INTO user_roles (
				product_name, 
				product_desc,
                product_price
				) VALUES (
				'{$row['product_name']}',
				'{$row['product_desc']}',
                '{$row['product_price']}'
				)";

			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			if($result){
				$product->id = mysqli_insert_id($this->link);
				return $product;
			}else{
				$this->handleError("Unable to insert product");
				return false;
			}
	    }

	    /**
	    * Updates a row in a table of the database
	    * @param {product}	$product	The model object to be updated
	    * @return {object}		Returns the same model object that was passed in as the param
	    */
	    function update($product){
            #TODO
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