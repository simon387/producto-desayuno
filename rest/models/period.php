<?php

include_once '../config/database.php';
include_once '../models/operation.php';

class Period
{
	private $conn;
	private $table_name = "pd_period";
	public $id;
	public $start;
	public $end;
	public $actual;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function readLast()
	{
		$query = "SELECT p.id, p.start, p.end, p.actual , (select count(*) from " . $this->table_name . ") as counter FROM " .
			$this->table_name . " p where p.actual = true";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function getPrevious($id)
	{
		$query = "select p.id, p.start, p.end, p.actual from " . $this->table_name . " p where p.end <= (" .
			"select i.start from " . $this->table_name . " i where i.id = " . $id . ") order by p.start desc limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function getNext($id)
	{
		$query = "select p.id, p.start, p.end, p.actual from " . $this->table_name . " p where p.start > (" .
			"select i.start from " . $this->table_name . "  i where i.id = " . $id . ") limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function readAll()
	{
		$query = "update " . $this->table_name . " set end=null where actual=true";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$query = "select p.id, p.start, p.end, p.actual from " . $this->table_name . " p ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function delete($id_, $lastOperation, $userid)
	{
		$query = "delete from " . $this->table_name . " where actual=false and id=" . $id_;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$database = new Database();
		$db = $database->getConnection();
		$operation = new Operation($db);
		$operation->user = $userid;
		$operation->product = null;
		$operation->description = $lastOperation;
		$operation->create();

		return $stmt;
	}

	function create(): bool
	{
		$query = "SELECT p.id FROM " . $this->table_name . " p WHERE p.actual = true";
		$stmt = $this->conn->prepare($query);
		if (!$stmt->execute()) {
			return false;
		}
		$id = 0;
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$oldId = $id;

		$query = "UPDATE " . $this->table_name . " p SET p.actual = false, p.end = now() WHERE p.id = " . $oldId;
		$stmt = $this->conn->prepare($query);
		if (!$stmt->execute()) {
			return false;
		}

		$query = "INSERT INTO " . $this->table_name . " (start, actual) values (now(), true)";
		$stmt = $this->conn->prepare($query);
		if (!$stmt->execute()) {
			return false;
		}

		$query = "SELECT p.id FROM " . $this->table_name . " p WHERE p.actual = true";
		$stmt = $this->conn->prepare($query);
		if (!$stmt->execute()) {
			return false;
		}
		$id = 0;
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$newId = $id;

		$query = "INSERT INTO pd_product (category, name, supplier, unit, note, deposit0, outflow0, outflow1, `left`, period) " .
			"SELECT category, name, supplier, unit, note, `left`, 0, 0, `left`, " . $newId . " FROM pd_product p WHERE p.period =" . $oldId;
		$stmt = $this->conn->prepare($query);
		return $stmt->execute();
	}
}
