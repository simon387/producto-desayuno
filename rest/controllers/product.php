<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, GET POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../services/ProductService.php';

$method = $_SERVER['REQUEST_METHOD'];
$productService = new ProductService();
$data = json_decode(file_get_contents("php://input"));

switch ($method) {
	case 'DELETE':
		if ($productService->delete($data)) {
			http_response_code(200);
			echo json_encode(array("response" => "Product deleted"));
		} else {
			http_response_code(500);
			echo json_encode(array("response" => "Impossible to delete the Product"));
		}
		break;
	case 'GET':
		$product_arr = $productService->getAllInLastPeriod();
		if (count($product_arr) > 0) {
			http_response_code(200);
			echo json_encode($product_arr);
		} else {
			http_response_code(500);
			echo json_encode(array("response" => "Impossible to get the Products"));
		}
		break;
	case 'POST':
		if ($productService->create($data)) {
			http_response_code(200);
			echo json_encode(array("response" => "Product created"));
		} else {
			http_response_code(500);
			echo json_encode(array("response" => "Impossible to create the Product"));
		}
		break;
	case 'PUT':
		if ($productService->modify($data)) {
			http_response_code(200);
			echo json_encode(array("response" => "Product edited"));
		} else {
			http_response_code(500);
			echo json_encode(array("response" => "Impossible to edit the Product"));
		}
		break;
	default:
		http_response_code(405);
		echo json_encode(array("response" => "Method not supported"));
		die();
}


