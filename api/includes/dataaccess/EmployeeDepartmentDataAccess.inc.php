<?php
// This example was the starter file I used for the EmployeeDepartmentDataAccess
// You may want to replace all occurences of EmployeeDepartment and $EmployeeDepartment with what ever model you are working with

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/Employee_department.inc.php"); // I had problems including this file, not sure why!


class EmployeeDepartmentDataAccess extends DataAccess{

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
	    * @param {EmployeeDepartment} $EmployeeDepartment 
	    * @return {array}
	    */
	    function convertModelToRow($department){
	    	$row['id'] = mysqli_real_escape_string($this->link, $department->id);
			$row['department_name'] = mysqli_real_escape_string($this->link, $department->department_name);
			$row['department_staff_count'] = mysqli_real_escape_string($this->link, $department->department_staff_count);
			$row['employee_id'] = mysqli_real_escape_string($this->link, $department->employee_id);
			$row['active'] = mysqli_real_escape_string($this->link, $department->active);
			return $row;
	    }

	    /**
	    * Converts a row from the database to a model object
	    * And scrubs the data to prevent XSS attacks
	    *
	    * @param {array} $row
	    * @return {EmployeeDepartment}		Returns a subclass of a Model 
	    */
	    function convertRowToModel($row){
	    	$department = new Employee_department();
			if(isset($row['id'])){
				$department->id = htmlentities($row['id']);
			}
			$department->department_name = htmlentities($row['department_name']);
			$department->department_staff_count = htmlentities($row['department_staff_count']);
			$department->employee_id = htmlentities($row['employee_id']);
			if(isset($row['active'])){
				$department->active = htmlentities($row['active']);
			}
			return $department;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $id 	The id of the item to get from a row in the database
	    * @return {EmployeeDepartment}		Returns an instance of a model object 
	    */
	    function getById($id){
			$qstr = "SELECT department_id as id, department_name, department_staff_count, employee_id FROM employee_department where 
			department_id = " . mysqli_real_escape_string($this->link, $id);
			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
			if($result->num_rows == 1){
				$row = mysqli_fetch_assoc($result);
				$department = $this->convertRowToModel($row);
				return $department;
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
			$qstr = "SELECT department_id as id, department_name, department_staff_count, employee_id FROM employee_department
			WHERE active = 'yes'";
			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
			$all = array();
			while($row = mysqli_fetch_assoc($result)){
				$department = $this->convertRowToModel($row);
				$all[] = $department;
			}
			return $all;
	    }


	    /**
	    * Inserts a row into a table in the database
	    * @param {EmployeeDepartment}	$EmployeeDepartment	The model object to be inserted
	    * @return {EmployeeDepartment}		Returns the same model object, but with the id property set 
	    *						(the id is assigned by the database)
	    */
	    function insert($department){
			$row = $this->convertModelToRow($department);
			$qstr = "INSERT INTO employee_department (
				department_name,
				department_staff_count,
				employee_id,
				active
				) VALUES (
					'{$row['department_name']}',
					'{$row['department_staff_count']}',
					'{$row['employee_id']}',
					'{$row['active']}' 
				)";
			$result = mysqli_query($this->link, $qstr) or $this->handleError(mysqli_error($this->link));
				if($result){
					$department->id = mysqli_insert_id($this->link);
					return $department;
				}else{
					$this->handleError("Unable to insert department");
					return false;
				}
	    }

	    /**
	    * Updates a row in a table of the database
	    * @param {EmployeeDepartment}	$EmployeeDepartment	The model object to be updated
	    * @return {boolean}				Returns true if the update succeeds	
	    */
	    function update($department, $delete = false){
			$row = $this->convertModelToRow($department);

			$qStr = "UPDATE employee_department SET
					department_name = '{$row['department_name']}',
					department_staff_count = '{$row['department_staff_count']}',
					employee_id = '{$row['employee_id']}',
					active = '{$row['active']}'
				WHERE department_id = " . $row['id'];

			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link)); 

			$mysqli_test = preg_split("/ +/", mysqli_info($this->link));
			$records = (int)$mysqli_test[2]; 
			$changes = (int)$mysqli_test[4];

			if($delete){
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Department is already non-active");
					return false;
				}else{
					$this->handleError("Unable to delete department");
					return false;
				}
			}else{
				if($result && mysqli_affected_rows($this->link) == 1){
					return true;
				}else if($records == 1 && $changes == 0){
					$this->handleError("Unable to update an employee department with no changes");
					return false;
				}else{
					$this->handleError("Unable to update employee department");
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