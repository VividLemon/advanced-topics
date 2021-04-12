<?php



// First a hacker tries to figure out a valid login
$user = "bob@bob.com";

/*
// Example 1
// Then they use a dictionary to try various passwords
$dictionary = ["aardvark", "abacus", "able", "apple"];

foreach ($dictionary as $word) {
	if(login($user, $word)){
		die("found it: $word");
	}
}

function login($username, $password){
	if($username == "bob@bob.com" && $password == "apple"){
		return true;
	}else{
		return false;
	}
}
*/



// Example 2
// You should always hash passwords when you stor them in the db
$hashed_password = md5("apple");
die(password_hash("apple", PASSWORD_DEFAULT));
//die($hashed_password);

// hackers can guess which hashing function (algorithm) and just hash the dictionary
$dictionary = [md5("aardvark"), md5("abacus"), md5("able"), md5("apple")];

foreach ($dictionary as $word) {
	if(login($user, $word)){
		die("found it: $word");
	}
}
	

function login($username, $password){
	if($username == "bob@bob.com" && $password == "1f3870be274f6c49b3e31a0c6728957f"){
		return true;
	}else{
		return false;
	}
}



/*
// Example 3
// you can add some 'salt' to a password
$salt = "x97#2"; // salt is a random string
$hashed_salted_password = md5($salt . "apple" . $salt);
//die($hashed_salted_password);

// hackers can guess which hashing function (algorithm) and just hash the dictionary
$dictionary = [md5("aardvark"), md5("abacus"), md5("able"), md5("apple")];

foreach ($dictionary as $word) {
	if(login($user, $word)){
		die("found it: $word");
	}
}
	

function login($username, $password){
	if($username == "bob@bob.com" && $password == "56ead960246af8144916c2ec82d40af0"){
		return true;
	}else{
		return false;
	}
}
*/







?>