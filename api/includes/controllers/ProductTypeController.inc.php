<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Product_type.inc.php");
include_once(__DIR__ . "/../dataaccess/ProductTypeDataAccess.inc.php");


class ProductTypeController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	/*
	Notes
	- We need to secure resources!
	- A robust web service will look at the Accept header in the request
	  and return the data in the requested format (for example json, xml, csv, etc)
	*/

	public function handle_product_types(){

		$da = new ProductTypeDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				// start off with just this inside this braanch
				$data = $this->getJSONRequestBody();

				$product_type = $da->convertRowToModel($data);
				if($product_type->isValid()){
					try{
						$product_type = $da->insert($product_type);
						$json = json_encode($product_type);

						$this->setContentType('json');
						$this->sendHeader(200);
						$this->allowCors();

						echo $json;
						die();
					}catch(Exception $e){
						$this->sendHeader(500,true, $e->getMessage());
					}
				}else{
					$msg = implode(', ', array_values($product_type->validationErrors));
					$this->sendHeader(400, true, $msg);
					die();
				}
				break;
			case "GET":
				$product_types = $da->getAll();
				$jsonProducts = json_encode($product_types, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				$this->sendHeader(200);
				$this->allowCors();

				echo $jsonProducts;
				die();
				break;
			case "OPTIONS":
				// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
				// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
				$this->allowCors();
				header("Access-Control-Allow-Methods: GET,POST");
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}



	public function handle_single_product_type(){

		$url_path = $this->getUrlPath();
		$url_path = $this->removeLastSlash($url_path);
		//echo($url_path);

		// extract the product id
		$id = null;		
		if(preg_match('/^productTypes\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new ProductTypeDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				//echo("GET PRODUCT $id");
				$product_type = $da->getById($id);
				$json = json_encode($product_type, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				$this->sendHeader(200);
				echo $json;
				die();
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$product_type = $da->convertRowToModel($data);
				if($product_type->isValid()){
					try{
						if($da->update($product_type)){
							$json = json_encode($product_type);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($product_type->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				if($product_type = $da->getById($id)){
					try{
						$product_type->active = "no";
						$da->update($product_type, true);
						$this->sendHeader(200);
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$this->sendHeader(400, msg: "Unable to delete product type, id: $id");
				}
				case "OPTIONS":
					// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
					// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
					$this->allowCors();
					header("Access-Control-Allow-Methods: GET,PUT,DELETE");
					break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}


}