<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../services/CategoryService.php';

$method = $_SERVER['REQUEST_METHOD'];
$categoryService = new CategoryService();

switch ($method) {
	case 'GET':
		$category_arr = $categoryService->getAll();
		if (count($category_arr) > 0) {
			http_response_code(200);
			echo json_encode($category_arr);
		} else {
			http_response_code(500);
			echo json_encode(array("response" => "Impossible to get the Categories"));
		}
		break;
	default:
		http_response_code(405);
		echo json_encode(array("response" => "Method not supported"));
		die();
}


