<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Product.inc.php");
include_once(__DIR__ . "/../dataaccess/ProductDataAccess.inc.php");


class ProductController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	/*
	Notes
	- We need to secure resources!
	- A robust web service will look at the Accept header in the request
	  and return the data in the requested format (for example json, xml, csv, etc)
	*/

	public function handle_products(){

		$da = new ProductDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				// start off with just this inside this braanch
				$data = $this->getJSONRequestBody();

				$product = $da->convertRowToModel($data);
				if($product->isValid()){
					try{
						$product = $da->insert($product);
						$json = json_encode($product);

						$this->setContentType('json');
						$this->sendHeader(200);
						$this->allowCors();

						echo $json;
						die();
					}catch(Exception $e){
						$this->sendHeader(500,true, $e->getMessage());
					}
				}else{
					$msg = implode(', ', array_values($product->validationErrors));
					$this->sendHeader(400, true, $msg);
					die();
				}
				break;
			case "GET":
				$products = $da->getAll();
				$jsonProducts = json_encode($products, JSON_PRETTY_PRINT);
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



	public function handle_single_product(){

		$url_path = $this->getUrlPath();
		$url_path = $this->removeLastSlash($url_path);
		//echo($url_path);

		// extract the product id
		$id = null;		
		if(preg_match('/^products\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new ProductDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				//echo("GET PRODUCT $id");
				$product = $da->getById($id);
				$json = json_encode($product, JSON_PRETTY_PRINT);
				$this->setContentType("json");
				$this->sendHeader(200);
				echo $json;
				die();
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$product = $da->convertRowToModel($data);
				if($product->isValid()){
					try{
						if($da->update($product)){
							$json = json_encode($product);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($product->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				if($product = $da->getById($id)){
					try{
						$product->active = "no";
						$da->update($product, true);
						$this->sendHeader(200);
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$this->sendHeader(400, msg: "Unable to delete product, id: $id");
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