<?php

require_once("DataAccess.inc.php");
include_once(__DIR__ . "/../models/Employee.inc.php"); // I had problems including this file, not sure why!


class employeeDataAccess extends DataAccess{

	    /**
	    * Constructor function for this class
	    * @param {mysqli} $link      A preconfigured connection to the database
	    */
	    function __construct($link){
			parent::__construct($link); // call the super constructor
	    }

	    /**
	    * Converts a model object into an assoc array and sets the keys
	    * to the proper names. For example a $employee->id is converted to $row['employee_id']
	    * The data should also be scrubbed to prevent SQL injection attacks
	    *
	    * @param {employee} $employee 
	    * @return {array}
	    */
	    function convertModelToRow($employee){
	    	$row['id'] = mysqli_real_escape_string($this->link, $employee->id);
            $row['user_id'] = mysqli_real_escape_string($this->link, $employee->user_id);
	    	$row['employee_dob'] = mysqli_real_escape_string($this->link, $employee->employee_dob);
            $row['employee_salary'] = mysqli_real_escape_string($this->link, $employee->employee_salary);
	    	$row['employee_part_time'] = mysqli_real_escape_string($this->link, $employee->employee_part_time);

			return $row;
	    }

	    /**
	    * Converts a row from the database to a model object
	    * And scrubs the data to prevent XSS attacks
	    *
	    * @param {array} $row
	    * @return {employee}		Returns a subclass of a Model 
	    */
	    function convertRowToModel($row){

	    	$employee = new employee();
			if(isset($row['id'])){
				$employee->id = htmlentities($row['id']);
			}
            $employee->user_id = htmlentities($row['user_id']);
			$employee->employee_dob = htmlentities($row['employee_dob']);
            $employee->employee_salary = htmlentities($row['employee_salary']);
            $employee->employee_part_time = htmlentities($row['employee_part_time']);
			return $employee;
	    }


	    /**
	    * Gets a row from the database by it's id
	    * @param {number} $id 	The id of the item to get from a row in the database
	    * @return {employee}		Returns an instance of a model object 
	    */
	    function getById($id){
			$qStr = "SELECT employee_id as id, user_id, employee_dob, employee_salary, employee_part_time FROM employees WHERE employee_id = " . mysqli_real_escape_string($this->link, $id);
			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			if($result->num_rows == 1){
				$row = mysqli_fetch_assoc($result);
				$employee = $this->convertRowToModel($row);
				return $employee;
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
			$qStr = "SELECT employee_id as id, user_id, employee_dob, employee_salary, employee_part_time FROM employees ";
			// foreach($args as $value){
			// 	$qStr .= trim($value); 
			// 	$qStr .= " ";
			// }
			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			$allemployees = array();
			while($row = mysqli_fetch_assoc($result)){
				$employee = $this->convertRowToModel($row);
				$allemployees[] = $employee;
			}
			return $allemployees;
	    }


	    /**
	    * Inserts a row into a table in the database
	    * @param {employee}	$employee	The model object to be inserted
	    * @return {employee}		Returns the same model object, but with the id property set 
	    *						(the id is assigned by the database)
	    */
	    function insert($employee){
			$row = $this->convertModelToRow($employee);
			$row['employee_dob'] = parent::convertDateForMySQL($row['employee_dob']);
			$qStr = "INSERT INTO employees (
				user_id, 
				employee_dob,
                employee_salary,
                employee_part_time
				) VALUES (
				'{$row['user_id']}',
                '{$row['employee_dob']}',
				'{$row['employee_salary']}',
				'{$row['employee_part_time']}'
				)";

			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
			if($result){
				$employee->id = mysqli_insert_id($this->link);
				return $employee;
			}else{
				$this->handleError("Unable to insert employee");
				return false;
			}
	    }

	    /**
	    * Updates a row in a table of the database
	    * @param {employee}	$employee	The model object to be updated
	    * @return {object}		Returns the same model object that was passed in as the param
	    */
	    function update($employee){
			$row = $this->convertModelToRow($employee);

			$qStr = "UPDATE employees SET
					user_id = '{$row['user_id']}',
					employee_dob = '{$row['employee_dob']}',
					employee_salary = '{$row['employee_salary']}',
					employee_part_time = '{$row['employee_part_time']}'
				WHERE employee_id = " . $row['id'];

			$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link)); 

			$mysqli_test = preg_split("/ +/", mysqli_info($this->link));
			$records = (int)$mysqli_test[2]; 
			$changes = (int)$mysqli_test[4];

			if($result && mysqli_affected_rows($this->link) == 1){
				return true;
			}else if($records == 1 && $changes == 0){
				$this->handleError("Unable to update an employee with no changes");
			}else{
				$this->handleError("Unable to update employee");
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
            #TODO YES
	    }
}