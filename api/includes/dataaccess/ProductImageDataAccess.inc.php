<?php
// This example was the starter file I used for the productDataAccess
// You may want to replace all occurences of product and $product_image with what ever model you are working with

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/Product_image.inc.php"); // I had problems including this file, not sure why!


class ProductImageDataAccess extends DataAccess{

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
	    * @param {product} $product_image 
	    * @return {array}
	    */
	    function convertModelToRow($product_image){
	    	$row['id'] = mysqli_real_escape_string($this->link, $product_image->id);
	    	$row['product_id'] = mysqli_real_escape_string($this->link, $product_image->product_id);
	    	$row['path'] = mysqli_real_escape_string($this->link, $product_image->path);
			$row['active'] = mysqli_real_escape_string($this->link, $product_image->active);
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
	    	$product_image = new Product_image();
			if(isset($row['id'])){
				$product_image->id = htmlentities($row['id']);
			}
            $product_image->product_id = htmlentities($row['product_id']);
            $product_image->path = htmlentities($row['path']);
			$product_image->active = htmlentities($row['active']);
            return $product_image;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $product_id 	The id of the item to get from a row in the database
	    * @return {product}		Returns an instance of a model object 
	    */
	    function getById($id){
            $qstr = "SELECT image_id as id, product_id, path, active FROM product_images
			where image_id = " . mysqli_real_escape_string($this->link, $id);
			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
			if($result->num_rows == 1){
				$row = mysqli_fetch_assoc($result);
				$product_image = $this->convertRowToModel($row);
				return $product_image;
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
            
	    }


	    /**
	    * Inserts a row into a table in the database
	    * @param {product}	$product_image	The model object to be inserted
	    * @return {product}		Returns the same model object, but with the id property set 
	    *						(the id is assigned by the database)
	    */
	    function insert($product_image){
            $row = $this->convertModelToRow($product_image);
			$qstr = "INSERT INTO product_images (
				product_id, 
				path,
				active
				) VALUES (
				'{$row['product_id']}',
				'{$row['path']}',
				'{$row['active']}'
				)";
			$result = mysqli_query($this->link,$qstr) or $this->handleError(mysqli_error($this->link));
			if($result){
				$product_image->id = mysqli_insert_id($this->link);
				return $product_image;
			}else{
				$this->handleError("Unable to insert image for product");
				return false;
			}
	    }

	    /**
	    * Updates a row in a table of the database
	    * @param {product}	$product_image	The model object to be updated
		* @param {boolean} $delete 		If true, will prepare for "deleting"
		*								and will submit the correct handleError()
	    * @return {boolean}				Returns true if the update succeeds	
	    */
	    function update($product_image, $delete = false){
			$row = $this->convertModelToRow($product_image);

			$qstr = "UPDATE product_images SET
			product_id = '{$row['product_id']}',
			path = '{$row['path']}',
			active = '{$row['active']}'
			WHERE image_id = " . $row['id'];

			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link)); 

			$mysqli_test = preg_split("/ +/", mysqli_info($this->link));
			$records = (int)$mysqli_test[2]; 
			$changes = (int)$mysqli_test[4];

			if($delete){
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Image is already non-active");
					return false;
				}else{
					$this->handleError("Unable to delete image");
					return false;
				}
			}else{
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Unable to update a image with no changes");
					return false;
				}else{
					$this->handleError("Unable to update image");
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
			$qstr = "DELETE FROM product_images WHERE image_id = " . mysqli_real_escape_string($this->link, $id);
			$result = mysqli_query($this->link, $qstr);
			if($result && mysqli_affected_rows($this->link) == 1){
				return true;
			}else{
				$this->handleError("Unable to delete image.");
			}
	    }
}