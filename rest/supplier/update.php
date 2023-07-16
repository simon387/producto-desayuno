<?php
require_once '../../rest/config/protect.php';
with('../../fe/login.php', "scope");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/supplier.php';

$database = new Database();
$db = $database->getConnection();

$supplier = new Supplier($db);

$data = json_decode(file_get_contents("php://input"));

$supplier->id = $data->id;
$supplier->name = $data->name;

if ($supplier->update($data->id, $data->name)) {
	http_response_code(200);
	echo json_encode(array("response" => "Supplier updated"));
} else {
	http_response_code(503);
	echo json_encode(array("response" => "Impossible to update the supplier data"));
}
