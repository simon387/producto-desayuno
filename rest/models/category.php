<?php

include_once '../config/database.php';

class Category
{
	private $conn;
	private $table_name = "pd_category";
	public $id;
	public $name;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function findAll(): ?array
	{
		$query = "SELECT c.id, c.name FROM " . $this->table_name . " c";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$num = $stmt->rowCount();

		if ($num > 0) {
			$category_arr = array();
			$category_arr["list"] = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);

				$category_item = array(
					"id" => $id,
					"name" => $name
				);

				$category_arr["list"][] = $category_item;
			}
			return $category_arr;
		}
		return null;
	}
}