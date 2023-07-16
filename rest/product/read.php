<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
include_once '../config/database.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
//$stmt = $product->getBySupplierAndPeriod($_GET['supplier_id'], $_GET['period_id']);
$stmt = $product->getByCategoryAndPeriod($_GET['category_id'], $_GET['period_id']);
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
			"period" => $period,
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
		array("message" => "No products found.")
	);
}
