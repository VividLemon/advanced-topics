<?php
// This example was the starter file I used for the productDataAccess
// You may want to replace all occurences of product and $product with what ever model you are working with

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/product.inc.php"); // I had problems including this file, not sure why!


class ProductDataAccess extends DataAccess{

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
	    	$row['id'] = mysqli_real_escape_string($this->link, $product->id);
	    	$row['product_name'] = mysqli_real_escape_string($this->link, $product->product_name);
	    	$row['product_desc'] = mysqli_real_escape_string($this->link, $product->product_desc);
	    	$row['product_price'] = mysqli_real_escape_string($this->link, $product->product_price);
			$row['type_id'] = mysqli_real_escape_string($this->link, $product->type_id);
			$row['active'] = mysqli_real_escape_string($this->link, $product->active);
			$row['path'] = mysqli_real_escape_string($this->link, $product->path);
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
			if(isset($row['id'])){
				$product->id = htmlentities($row['id']);
			}
            $product->product_name = htmlentities($row['product_name']);
            $product->product_desc = htmlentities($row['product_desc']);
            $product->product_price = htmlentities($row['product_price']);
			$product->type_id = htmlentities($row['type_id']);
			if(isset($row['active'])){
				$product->active = htmlentities($row['active']);
			}
			if(isset($row['path'])){
				$product->path = htmlentities($row['path']);
			}
            return $product;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $id 	The id of the item to get from a row in the database
	    * @return {product}		Returns an instance of a model object 
	    */
	    function getById($id){
            $qstr = "SELECT products.product_id as id, product_name, product_desc, product_price, type_id, group_concat(product_images.path) as path FROM products 
			LEFT JOIN product_images ON products.product_id = product_images.product_id
			WHERE products.product_id = " . mysqli_real_escape_string($this->link, $id);
            $result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
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
            $qstr = "SELECT products.product_id as id, product_name, product_desc, product_price, type_id, group_concat(product_images.path) as path FROM products
			LEFT JOIN product_images ON products.product_id = product_images.product_id
			WHERE products.active = 'yes'
			GROUP BY products.product_id";
            $result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
			$all = array();
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
			$qStr = "INSERT INTO products (
				product_name, 
				product_desc,
                product_price,
				type_id,
				active
				) VALUES (
				'{$row['product_name']}',
				'{$row['product_desc']}',
                '{$row['product_price']}',
				'{$row['type_id']}',
				'{$row['active']}'
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
		* @param {boolean} $delete 		If true, will prepare for "deleting"
		*								and will submit the correct handleError()
	    * @return {boolean}				Returns true if the update succeeds	
	    */
	    function update($product, $delete = false){
            $row = $this->convertModelToRow($product);

			$qStr = "UPDATE products SET
					product_name = '{$row['product_name']}',
					product_desc = '{$row['product_desc']}',
					product_price = '{$row['product_price']}',
					type_id = '{$row['type_id']}',
					active = '{$row['active']}'
				WHERE product_id = " . $row['id'];

			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link)); 

			$mysqli_test = preg_split("/ +/", mysqli_info($this->link));
			$records = (int)$mysqli_test[2]; 
			$changes = (int)$mysqli_test[4];

			if($delete){
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Product is already non-active");
					return false;
				}else{
					$this->handleError("Unable to delete product");
					return false;
				}
			}else{
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Unable to update a product with no changes");
					return false;
				}else{
					$this->handleError("Unable to update product");
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