<?php
session_start(); // we'll use sessions to securing resources, although I'm not sure we should

// We need to discuss URL rewriting before we do this

include_once("includes/config.inc.php");
include_once("includes/Router.inc.php");

// Get the requested url path (thanks to the m6agic of mod_rewrite)
// Note that the .htaccess file is configured to redirect to this page
// and append the requested path to the query string, for example: index.php?url_path=users/1
$url_path = $_GET['url_path'] ?? "";
//die($url_path);

if($url_path == ""){
	die("show the api documentation page");
}

$routes = [
	"users/" => ["controller" => "UserController", "action" => "handleUsers"],
	"users/:id" => ["controller" => "UserController", "action" => "handleSingleUser"],
	"roles/" => ["controller" => "RoleController", "action" => "handle_roles"],
	"roles/:id" => ["controller" => "RoleController", "action" => "handle_single_role"],
	"employees/" => ["controller" => "EmployeeController", "action" => "handle_employees"],
	"employees/:id" => ["controller" => "EmployeeController", "action" => "handle_single_employee"],
	"departments/" => ["controller" => "EmployeeDepartmentController", "action" => "handle_employee_departments"],
	"departments/:id" => ["controller" => "EmployeeDepartmentController", "action" => "handle_single_department"],
	"products/" => ["controller" => "ProductController", "action" => "handle_products"],
	"products/:id" => ["controller" => "ProductController", "action" => "handle_single_product"],
	"productTypes/" => ["controller" => "ProductTypeController", "action" => "handle_product_types"],
	"productTypes/:id" => ["controller" => "ProductTypeController", "action" => "handle_single_product_type"],
	"login" => ["controller" => "LoginController", "action" => "handleLogin"],
	"logout" => ["controller" => "LoginController", "action" => "handleLogout"]
];

$router = new Router($routes);


// IDEA - have the students set up their routes and then
// test my router, just make sure that its returning the correct controller/action
// for each of their routes.
// Start off by giving the students this page
$route = $router->getController($url_path);

if($route = $router->getController($url_path)){
	$className = $route['controller'];
	$method = $route['action'];
	
	include_once("includes/controllers/$className.inc.php");
	$controller = new $className(get_link());
	call_user_func(array($controller, $method));
}else{
	header('HTTP/1.1 400 Bad Request');
}
die();

?>