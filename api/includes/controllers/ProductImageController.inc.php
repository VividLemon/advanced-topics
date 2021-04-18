<?php

include_once("Controller.inc.php");
include_once(__DIR__ . "/../models/Product.inc.php");
include_once(__DIR__ . "/../dataaccess/ProductImageDataAccess.inc.php");


class ProductImageController extends Controller{


	function __construct($link){
		parent::__construct($link);
	}


	/*
	Notes
	- We need to secure resources!
	- A robust web service will look at the Accept header in the request
	  and return the data in the requested format (for example json, xml, csv, etc)
	*/

	public function handle_product_images(){

		$da = new ProductImageDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "POST":
				// start off with just this inside this braanch
				$data = $this->getJSONRequestBody();

				$product_image = $da->convertRowToModel($data);
				if($product_image->isValid()){
					try{
						$product_image = $da->insert($product_image);
						$json = json_encode($product_image);

						$this->setContentType('json');
						$this->sendHeader(200);
						$this->allowCors();

						echo $json;
						die();
					}catch(Exception $e){
						$this->sendHeader(500,true, $e->getMessage());
					}
				}else{
					$msg = implode(', ', array_values($product_image->validationErrors));
					$this->sendHeader(400, true, $msg);
					die();
				}
				break;
			case "GET":
				
			case "OPTIONS":
				// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
				// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
				$this->allowCors();
				header("Access-Control-Allow-Methods: POST");
				break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}



	public function handle_single_image(){

		$url_path = $this->getUrlPath();
		$url_path = $this->removeLastSlash($url_path);
		//echo($url_path);

		// extract the product id
		$id = null;		
		if(preg_match('/^images\/([0-9]*\/?)$/', $url_path, $matches)){
			$id = $matches[1];
		}
		
		$da = new ProductImageDataAccess($this->link);
		$this->allowCors();

		switch($_SERVER['REQUEST_METHOD']){
			case "GET":
				break;
			case "PUT":
				$data = $this->getJSONRequestBody();
				$product_image = $da->convertRowToModel($data);
				if($product_image->isValid()){
					try{
						if($da->update($product_image)){
							$json = json_encode($product_image);
							$this->setContentType('json');
							$this->sendHeader(200);
							echo $json;
						}
					}catch(Exception $e){
						$this->sendHeader(400, true, $e->getMessage());
					}
					die();
				}else{
					$msg = implode(',', array_values($product_image->validationErrors));
					$this->sendHeader(406, true, $msg);
					die();
				}
				break;
			case "DELETE":
				// if($product_image = $da->getById($id)){
				// 	try{
				// 		$product_image->active = "no";
				// 		$da->update($product_image, true);
				// 		$this->sendHeader(200);
				// 	}catch(Exception $e){ 
				// 		$this->sendHeader(400, true, $e->getMessage());
				// 	}
				// 	die();
				// }else{
				// 	$this->sendHeader(400, msg: "Unable to delete image, id: $id");
				// }

					if($product_image = $da->getById($id)){
						$da->delete($product_image->id);
					}

				break;
				case "OPTIONS":
					// AJAX CALLS WILL OFTEN SEND AN OPTIONS REQUEST BEFORE A PUT OR DELETE
					// TO SEE IF THE PUT/DELETE WILL BE ALLOWED
					$this->allowCors();
					header("Access-Control-Allow-Methods: PUT, DELETE");
					break;
			default:
				// set a 400 header (invalid request)
				$this->sendHeader(400);
		}
	}


}