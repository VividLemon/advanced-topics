<?php

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/Role.inc.php"); // I had problems including this file, not sure why!


class RoleDataAccess extends DataAccess{

	    /**
	    * Constructor function for this class
	    * @param {mysqli} $link      A preconfigured connection to the database
	    */
	    function __construct($link){
			parent::__construct($link); // call the super constructor
	    }

	    /**
	    * Converts a model object into an assoc array and sets the keys
	    * to the proper names. For example a $role->id is converted to $row['user_role_id']
	    * The data should also be scrubbed to prevent SQL injection attacks
	    *
	    * @param {Role} $role 
	    * @return {array}
	    */
	    function convertModelToRow($role){
	    	$row['id'] = mysqli_real_escape_string($this->link, $role->id);
	    	$row['role_name'] = mysqli_real_escape_string($this->link, $role->role_name);
	    	$row['role_desc'] = mysqli_real_escape_string($this->link, $role->role_desc);
			$row['active'] = mysqli_real_escape_string($this->link, $role->active);
			return $row;
	    }

	    /**
	    * Converts a row from the database to a model object
	    * And scrubs the data to prevent XSS attacks
	    *
	    * @param {array} $row
	    * @return {Role}		Returns a subclass of a Model 
	    */
	    function convertRowToModel($row){

	    	$role = new Role();
			if(isset($row['id'])){
				$role->id = htmlentities($row['id']);
			}
			$role->role_name = htmlentities($row['role_name']);
			$role->role_desc = htmlentities($row['role_desc']);
			if(isset($row['active'])){
				$role->active = htmlentities($row['active']);
			}
			return $role;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $id 	The id of the item to get from a row in the database
	    * @return {Role}		Returns an instance of a model object 
		* Returns false if fails
	    */
	    function getById($id){
			$qStr = "SELECT user_role_id as id, user_role_name as role_name, user_role_desc as role_desc, active FROM user_roles WHERE 
			user_role_id = " . mysqli_real_escape_string($this->link, $id);
			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			if($result->num_rows == 1){
				$row = mysqli_fetch_assoc($result);
				$role = $this->convertRowToModel($row);
				return $role;
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
			$qStr = "SELECT user_role_id as id , user_role_name as role_name, user_role_desc as role_desc, active FROM user_roles 
			WHERE active = 'yes'";
			// foreach($args as $value){
			// 	$qStr .= trim($value); 
			// 	$qStr .= " ";
			// }
			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			$allRoles = array();
			while($row = mysqli_fetch_assoc($result)){
				$role = $this->convertRowToModel($row);
				$allRoles[] = $role;
			}
			return $allRoles;
	    }


	    /**
	    * Inserts a row into a table in the database
	    * @param {Role}	$role	The model object to be inserted
	    * @return {Role}		Returns the same model object, but with the id property set 
	    *						(the id is assigned by the database)
		* Returns handleError() and false if fails
	    */
	    function insert($role){
			$row = $this->convertModelToRow($role);
			$qStr = "INSERT INTO user_roles (
				user_role_name, 
				user_role_desc,
				active
				) VALUES (
				'{$row['role_name']}',
				'{$row['role_desc']}',
				'{$row['active']}'
				)";

			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			if($result){
				$role->id = mysqli_insert_id($this->link);
				return $role;
			}else{
				$this->handleError("Unable to insert role");
				return false;
			}
	    }

	    /**
	    * Updates a row in a table of the database
	    * @param {Role}	$role	The model object to be updated
		* @param {boolean} $delete 		If true, will prepare for "deleting"
	 	*								and will submit the correct handleError()
	    * @return {boolean}		Returns true if the update succeeds		
		* Returns handleError() and false if fails
	    */
	    function update($role, $delete = false){
			$row = $this->convertModelToRow($role);
			$qstr = "UPDATE user_roles SET
			user_role_name = '{$row['role_name']}',
			user_role_desc = '{$row['role_desc']}',
			active = '{$row['active']}'
			WHERE user_role_id = " . $row['id'];

			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));

			$mysqli_test = preg_split("/ +/", mysqli_info($this->link));
			$records = (int)$mysqli_test[2]; 
			$changes = (int)$mysqli_test[4];

			if($delete){
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Role is already non-active");
					return false;
				}else{
					$this->handleError("Unable to delete role");
					return false;
				}
			}else{
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Unable to update a role with no changes");
					return false;
				}else{
					$this->handleError("Unable to update role");
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