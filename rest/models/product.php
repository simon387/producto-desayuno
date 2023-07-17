<?php

include_once '../config/database.php';
include_once '../models/operation.php';

class Product
{
	private $conn;
	private $table_name = "pd_product";
	public $id;
	public $category;
	public $name;
	public $supplier;
	public $unit;
	public $deposit0;
	public $deposit1;
	public $outflow0;
	public $outflow1;
	public $left;
	public $period;
	public $note;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function getBySupplierAndPeriod($supplierID, $periodID)
	{
		$query = "SELECT p.id, p.category, p.name, p.supplier, p.unit, p.deposit0, p.deposit1, p.outflow0, " .
			"p.outflow1, p.left, p.period, p.note, (select description from pd_operation o where o.product = p.id order by " .
			"timestamp desc limit 1) as 'lastOperation' FROM " . $this->table_name . " p WHERE " .
			"p.supplier = " . $supplierID . " AND p.period = " . $periodID;

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function getByCategoryAndPeriod($categoryID, $periodID)
	{
		$query = "SELECT p.id, p.category, p.name, p.supplier, p.unit, p.deposit0, p.deposit1, p.outflow0, " .
			"p.outflow1, p.left, p.period, p.note, (select description from pd_operation o where o.product = p.id order by " .
			"timestamp desc limit 1) as 'lastOperation' FROM " . $this->table_name . " p WHERE " .
			"p.category = " . $categoryID . " AND p.period = " . $periodID;

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function update($userId, $description): bool
	{
		$query = "UPDATE " . $this->table_name . "
            SET
                deposit0 = :deposit0,
                deposit1 = :deposit1,
                outflow0 = :outflow0,
                outflow1 = :outflow1,
                `left` = :left
            WHERE
                id = :id";

		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->deposit0 = htmlspecialchars(strip_tags($this->deposit0));
		$this->deposit1 = htmlspecialchars(strip_tags($this->deposit1));
		$this->outflow0 = htmlspecialchars(strip_tags($this->outflow0));
		$this->outflow1 = htmlspecialchars(strip_tags($this->outflow1));
		$this->left = htmlspecialchars(strip_tags($this->left));

		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":deposit0", $this->deposit0);
		$stmt->bindParam(":deposit1", $this->deposit1);
		$stmt->bindParam(":outflow0", $this->outflow0);
		$stmt->bindParam(":outflow1", $this->outflow1);
		$stmt->bindParam(":left", $this->left);

		if ($stmt->execute()) {
			$database = new Database();
			$db = $database->getConnection();
			$operation = new Operation($db);
			$operation->user = $userId;
			$operation->product = $this->id;
			$operation->description = $description;
			if ($operation->create()) {
				return true;
			}
		}

		return false;
	}

	function search($query_, $period_)
	{
		$query = "select p.id, p.category, p.name, s.name as supplier, p.unit, p.deposit0, p.deposit1, p.outflow0, p.outflow1, p.`left`, p.note" .
			",(select description from pd_operation o where o.product = p.id order by timestamp desc limit 1) as 'lastOperation' " .
			"from " . $this->table_name . " p, pd_supplier s where p.supplier = s.id and p.period = " . $period_ .
			" and p.name like '%" . $query_ . "%'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function delete($id_): bool
	{
		$query = "delete from " . $this->table_name . " where id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id", $id_);

		return $stmt->execute();
	}

	function findAllInLastPeriod(): ?array
	{
		$query = "SELECT p.id, p.name, p.supplier, p.unit, p.note FROM " . $this->table_name . " p WHERE " .
			"p.period = (select id from pd_period where actual = true)";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$num = $stmt->rowCount();

		if ($num > 0) {
			$product_arr = array();
			$product_arr["list"] = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);

				$product_item = array(
					"id" => $id,
					"name" => $name,
					"supplier" => $supplier,
					"unit" => $unit,
					"note" => $note
				);

				$product_arr["list"][] = $product_item;
			}
			return $product_arr;
		}
		return null;
	}

	function create($name_, $supplier_, $unit_, $note_): bool
	{
		$query = "INSERT INTO " . $this->table_name .
			" (category, name, supplier, unit, deposit0, deposit1, outflow0, outflow1, `left`, period, note) VALUES " .
			"(1, :name, :supplier, :unit, 0, 0, 0, 0, 0, (select id from pd_period where actual = true), :note)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":name", $name_);
		$stmt->bindParam(":supplier", $supplier_);
		$stmt->bindParam(":unit", $unit_);
		$stmt->bindParam(":note", $note_);

		return $stmt->execute();
	}

	function modify($id_, $name_, $supplier_, $unit_, $note_): bool
	{
		$query = "UPDATE " . $this->table_name . "
            SET
                name = :name,
                supplier = :supplier,
                unit = :unit,
                note = :note
            WHERE
                id = :id";

		$stmt = $this->conn->prepare($query);

		$id_ = htmlspecialchars(strip_tags($id_));
		$name_ = htmlspecialchars(strip_tags($name_));
		$supplier_ = htmlspecialchars(strip_tags($supplier_));
		$unit_ = htmlspecialchars(strip_tags($unit_));
		$note_ = htmlspecialchars(strip_tags($note_));

		$stmt->bindParam(":id", $id_);
		$stmt->bindParam(":name", $name_);
		$stmt->bindParam(":supplier", $supplier_);
		$stmt->bindParam(":unit", $unit_);
		$stmt->bindParam(":note", $note_);

		return $stmt->execute();
	}
}