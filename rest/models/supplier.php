<?php

class Supplier
{
	private $conn;
	private $table_name = "pd_supplier";
	public $id;
	public $name;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function readAll()
	{
		$query = "SELECT s.id, s.name FROM " . $this->table_name . " s";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function update($id_, $name_)
	{
		$query = "update " . $this->table_name . " set name='" . $name_ . "' where id=" . $id_;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function create($name_): bool
	{
		$query = "insert into " . $this->table_name . " (name) values (:name)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":name", $name_);

		return $stmt->execute();
	}
}
