<?php
require_once '../config/protect.php';
with('../../login.php', "scope");
include_once '../config/database.php';
include_once '../models/period.php';

$database = new Database();
$db = $database->getConnection();

$period = new Period($db);
$stmt = $period->getPrevious($_GET['id']);

$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);

$period_item = array(
	"id" => $id,
	"start" => $start,
	"end" => $end,
	"actual" => $actual,
);

http_response_code(200);
echo json_encode($period_item);
