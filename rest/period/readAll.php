<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
include_once '../config/database.php';
include_once '../models/period.php';

$database = new Database();
$db = $database->getConnection();

$period = new Period($db);
$stmt = $period->readAll();
$num = $stmt->rowCount();

if ($num > 0) {
	$period_arr = array();
	$period_arr["list"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$period_item = array(
			"id" => $id,
			"start" => $start,
			"end" => $end,
			"actual" => $actual,
		);

		$period_arr["list"][] = $period_item;
	}

	http_response_code(200);
	echo json_encode($period_arr);
} else {
	http_response_code(404);
	echo json_encode(
		array("message" => "No Periods found.")
	);
}