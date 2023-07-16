<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/period.php';

$database = new Database();
$db = $database->getConnection();

$period = new Period($db);

$data = json_decode(file_get_contents("php://input"));

if ($period->delete($_GET['id'], $data->lastOperation, $data->userId)) {
	http_response_code(200);
	echo json_encode(array("message" => "Deleted a Period."));
} else {
	http_response_code(503);
	echo json_encode(array("message" => "Error on deleting a Period"));
}
