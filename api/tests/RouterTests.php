<?php

include_once("../includes/Router.inc.php");


$routes = [
	"users/" => ["controller" => "UserController", "action" => "handleUsers"],
	"users/:id" => ["controller" => "UserController", "action" => "handleSingleUser"],
	"roles/" => ["controller" => "RoleController", "action" => "handleRoles"],
	"customers/:id/orders" =>	["controller" => "CustomerController", "action" => "getCustomerOrders"]
];


$testResults = array();

testInvalidPath();
testValidPaths();

// wrap each test result message in a div
$testResults = array_map(function($str){
	return "<div>$str</div>";
}, $testResults);

echo(implode($testResults));




function testInvalidPath(){
	global $testResults, $routes;

	$testResults[] = "<h3>TESTING invalid paths</h3>";

	$router = new Router($routes);

	$path = "some/invalid/path";
	if($router->getController($path) === false){
		$testResults[] = "PASS -  Returned  false for invalid path.";
	}else{
		$testResults[] = "Failed -  Did NOT return  false for invalid path.";
	}


}

function testValidPaths(){

	global $testResults, $routes;

	
	$testResults[] = "<h3>TESTING users/</h3>";
	$router = new Router($routes);
	$path = "users/";
	$expectedRoute = ["controller" => "UserController", "action" => "handleUsers"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>users/</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>users/</b> path.";
	}



	$testResults[] = "<h3>TESTING users</h3>";
	$router = new Router($routes);
	$path = "users";
	$expectedRoute = ["controller" => "UserController", "action" => "handleUsers"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>users</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>users</b> path.";
	}



	$testResults[] = "<h3>TESTING users/7</h3>";
	$router = new Router($routes);
	$path = "users/7";
	$expectedRoute = ["controller" => "UserController", "action" => "handleSingleUser"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>users/7</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>users/7</b> path.";
	}


	$testResults[] = "<h3>TESTING users/7/</h3>";
	$router = new Router($routes);
	$path = "users/7";
	$expectedRoute = ["controller" => "UserController", "action" => "handleSingleUser"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>users/7/</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>users/7/</b> path.";
	}





	$testResults[] = "<h3>TESTING roles</h3>";
	$router = new Router($routes);
	$path = "roles";
	$expectedRoute = ["controller" => "RoleController", "action" => "handleRoles"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>roles</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>roles</b> path.";
	}


	$testResults[] = "<h3>TESTING roles/</h3>";
	$router = new Router($routes);
	$path = "roles/";
	$expectedRoute = ["controller" => "RoleController", "action" => "handleRoles"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>roles/</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>roles/</b> path.";
	}




	$testResults[] = "<h3>TESTING customers/7/orders</h3>";
	$router = new Router($routes);
	$path = "customers/7/orders";
	$expectedRoute = ["controller" => "CustomerController", "action" => "getCustomerOrders"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>customers/7/orders</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>customers/7/orders</b> path.";
	}


	$testResults[] = "<h3>TESTING customers/7/orders/</h3>";
	$router = new Router($routes);
	$path = "customers/7/orders/";
	$expectedRoute = ["controller" => "CustomerController", "action" => "getCustomerOrders"];
	$actualRoute = $router->getController($path);
	
	// There should be no differences between the expectedRoute and the actualRoute
	$diff = array_diff_assoc($expectedRoute, $actualRoute);

	if(empty($diff)){
		$testResults[] = "PASS -  Returned the proper controller and action for the <b>customers/7/orders/</b> path.";
	}else{
		$testResults[] = "Failed -  Did NOT return the proper controller and action for the <b>customers/7/orders/</b> path.";
	}

	

}