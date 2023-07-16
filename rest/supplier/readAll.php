<?php
require_once '../../rest/config/protect.php';
with('../../login.php', "scope");
include_once '../config/database.php';
include_once '../models/supplier.php';

$database = new Database();
$db = $database->getConnection();

$supplier = new Supplier($db);
$stmt = $supplier->readAll();
$num = $stmt->rowCount();

if ($num > 0) {
	$supplier_arr = array();
	$supplier_arr["list"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$supplier_item = array(
			"id" => $id,
			"name" => $name,
		);

		$supplier_arr["list"][] = $supplier_item;
	}

	http_response_code(200);
	echo json_encode($supplier_arr);
} else {
	http_response_code(404);
	echo json_encode(
		array("message" => "No suppliers found.")
	);
}