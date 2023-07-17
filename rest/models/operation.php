<?php

class Operation
{
	private $conn;
	private $table_name = "pd_operation";
	public $id;
	public $user;
	public $timestamp;
	public $product;
	public $description;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function create(): bool
	{
		$query = "INSERT INTO " . $this->table_name . " (user_, product, description) VALUES (:user, :product, :description)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":user", $this->user);
		$stmt->bindParam(":product", $this->product);
		$stmt->bindParam(":description", $this->description);

		return $stmt->execute();
	}

	//FIX ME generalize the operation table
	function readAll()
	{
		$query = "select o.id, u.name as user, o.timestamp, concat(s.name, ' - ', p.name) as product, o.description from pd_operation o, pd_user u, pd_product p, pd_supplier s where o.user_ = u.id and o.product = p.id and p.supplier = s.id union ( select o.id, u.name as user, o.timestamp, '' as product, o.description from pd_operation o, pd_user u where o.user_ = u.id and o.product is null) order by timestamp desc";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}
