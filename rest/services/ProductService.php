<?php

include_once '../config/database.php';
include_once '../models/product.php';
include_once '../config/config.php';

class ProductService
{
	private $database;
	private $connection;
	private $product;

	public function __construct()
	{
		$this->database = new Database();
		$this->connection = $this->database->getConnection();
		$this->product = new Product($this->connection);
	}

	function delete($data): bool
	{
		if (empty($data->id)) {
			return false;
		}

		return $this->product->delete($data->id);
	}

	function getAllInLastPeriod(): ?array
	{
		return $this->product->findAllInLastPeriod();
	}

	function modify($data): bool
	{
		if (empty($data->id) || empty($data->name) || empty($data->supplier)) {
			return false;
		}

		return $this->product->modify($data->id, $data->name, $data->supplier, $data->unit, $data->note);
	}

	function create($data): bool
	{
		if (empty($data->name) || empty($data->supplier)) {
			return false;
		}

		return $this->product->create($data->name, $data->supplier, $data->unit, $data->note);
	}
}
