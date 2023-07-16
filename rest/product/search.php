<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$stmt = $product->search($data->query, $data->period);
$num = $stmt->rowCount();

if ($num > 0) {
	$product_arr = array();
	$product_arr["list"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$product_item = array(
			"id" => $id,
			"category" => $category,
			"name" => $name,
			"supplier" => $supplier,
			"unit" => $unit,
			"deposit0" => $deposit0,
			"deposit1" => $deposit1,
			"outflow0" => $outflow0,
			"outflow1" => $outflow1,
			"left" => $left,
			"note" => $note,
			"lastOperation" => $lastOperation,
		);

		$product_arr["list"][] = $product_item;
	}

	http_response_code(200);
	echo json_encode($product_arr);
} else {
	http_response_code(404);
	echo json_encode(
		array("message" => "No Product Found.")
	);
}