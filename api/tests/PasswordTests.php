<?php
include_once("../includes/dataaccess/UserDataAccess.inc.php");
include_once("../includes/models/User.inc.php");

// Set up the db connection
$testDB = "test_db";
$testServer = "localhost";
$testLogin = "root";
$testPassword = ""; // set the password 
$link = mysqli_connect($testServer, $testLogin, $testPassword, $testDB);

if(!$link){
	die("Unable to connect to test db");
}

$dropUsersTable = "DROP TABLE IF EXISTS users;";

$createUsersTable = "
	CREATE TABLE IF NOT EXISTS users (
	  user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	  user_first_name varchar(30) NOT NULL,
	  user_last_name varchar(30) NOT NULL,
	  user_email varchar(255) NOT NULL UNIQUE,
	  user_password char(255) NOT NULL,
	  user_salt char(32) NOT NULL,
	  user_role INT NOT NULL DEFAULT '1',
	  user_active enum('yes','no') NOT NULL DEFAULT 'yes'
	  # , FOREIGN KEY (user_role) REFERENCES user_roles(user_role_id)
	);";

$populateUsersTable = "
	INSERT INTO users (user_first_name,user_last_name, user_email, user_password, user_salt, user_role, user_active) VALUES 
	('John', 'Doe','john@doe.com', 'opensesame', 'xxx', '1', 'yes'),
	('Jane', 'Doe','jane@doe.com', 'letmein', 'xxx', '2', 'yes'),
	('Bob', 'Smith','bob@smith.com', 'test', 'xxx', '2', 'yes');";	

mysqli_query($link, $dropUsersTable) or die(mysqli_error($link));
mysqli_query($link, $createUsersTable) or die(mysqli_error($link));
mysqli_query($link, $populateUsersTable) or die(mysqli_error($link));



///////START CODING HERE......

$da = new UserDataAccess($link);

$salt = $da->getRandomSalt();
$password = "test";

$hased_password = $da->saltAndHashPassword($salt, $password);



$email = "john@doe.com";
if($user = $da->login($email, $password)){
	die($user);
}else{
	die("auth failed");
}

die("<h1>Make sure to salt and hash passwords when users are INSERTED!!!</h1>");
