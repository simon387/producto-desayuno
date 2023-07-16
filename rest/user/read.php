<?php
require_once '../../rest/config/protect.php';
with('../../fe/login.php', "scope");
include_once '../config/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$stmt = $user->getInfoById($_GET['id']);

$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);

$user_item = array(
	"id" => $id,
	"email" => $email,
	"name" => $name,
	"role" => $role,
);

http_response_code(200);
echo json_encode($user_item);
