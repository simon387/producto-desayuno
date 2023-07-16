<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
include_once '../config/database.php';
include_once '../models/operation.php';

$database = new Database();
$db = $database->getConnection();

$operation = new Operation($db);
$stmt = $operation->readAll();
$num = $stmt->rowCount();

if ($num > 0) {
	$operation_arr = array();
	$operation_arr["list"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$operation_item = array(
			"id" => $id,
			"user" => $user,
			"timestamp" => $timestamp,
			"product" => $product,
			"description" => $description
		);

		$operation_arr["list"][] = $operation_item;
	}

	http_response_code(200);
	echo json_encode($operation_arr);
} else {
	http_response_code(404);
	echo json_encode(
		array("message" => "No Operations found.")
	);
}